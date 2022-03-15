import React, {Component} from "react";
import ReactDOM from "react-dom";
import AceEditor from "react-ace";
import "ace-builds/src-noconflict/mode-json";
import "ace-builds/src-noconflict/theme-github";
// import 'ace-builds/webpack-resolver';
import ace from "ace-builds";
import 'bootstrap';
import * as PropTypes from "prop-types";
import {LOCAL_STORAGE_KEY} from "../../config";
// `webpack` would return the url for `worker-json.js`
// then we use it to configure `ace`
import jsonWorkerUrl from "file-loader!ace-builds/src-noconflict/worker-json";

ace.config.setModuleUrl("ace/mode/json_worker", jsonWorkerUrl);

const defaultValue = {
    title: "Title",
    description: "Description",
    logoPosition: "right",
    pages: [
        {
            "name": "page1",
            "elements": [
                {
                    "type": "text",
                    "name": "question1"
                }
            ]
        }
    ]
};

function getLastUpdateValue() {
    let value = window.localStorage.getItem(LOCAL_STORAGE_KEY);

    if (value) {
        return value;
    } else {
        return JSON.stringify(defaultValue, null, 4);
    }
}

class JsonEditor extends Component {
    static propsTypes = {
        defaultValue: PropTypes.string,
        handleChange: PropTypes.func,
        width: PropTypes.string,
        height: PropTypes.string
    }

    static defaultProps = {
        defaultValue: getLastUpdateValue(),
        handleChange: (newValue) => {
            window.localStorage.setItem(LOCAL_STORAGE_KEY, newValue);
            console.log('change ' + newValue);
        },
        width: "100%",
        height: "500px"
    }

    constructor(props) {
        super(props);

        if(this.props.defaultValue){
            window.localStorage.setItem(LOCAL_STORAGE_KEY, this.props.defaultValue);
        } else{
            this.props.defaultValue = getLastUpdateValue();
        }


    }

    render() {
        return <AceEditor
            mode="json"
            theme="github"
            onChange={this.props.handleChange}
            defaultValue={this.props.defaultValue}
            name="UNIQUE_ID_OF_DIV"
            width={this.props.width}
            height={this.props.height}
            editorProps={{$blockScrolling: true}}
        />
    }
}

export default JsonEditor

// for test
// if (document.getElementById('json-editor')) {
//     ReactDOM.render(<JsonEditor/>, document.getElementById('json-editor'));
// }
