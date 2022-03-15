import {Component} from 'react';
import ReactDOM from "react-dom";
import Card from "../layouts/Card";
import Base from "../layouts/Base";
import axios from "axios";

const dtStyle = {
    borderTop: "1px solid #e8e8e8",
    color: "#000",
    margin: "9px 0 0 0",
    padding: "10px 0 0 0",
    fontSize: "18px",
    cursor: "pointer"
};

const ddStyle = {
    fontSize: "15px",
    color: "#a6a6a6",
    cursor: "pointer"
};

class SurveyList extends Component {

    constructor(props) {
        super(props);
        this.state = {
            surveyList: []
        }

        this.getDataFromApi();
    }

    getDataFromApi = () => {
        axios.get('/api/survey')
            .then((res) => {
                console.log('get survey json: ' + JSON.stringify(res.data));

                if (res.data.length === 0) {
                    this.setState({
                        surveyList: <dt style={dtStyle}>Not Found Data</dt>
                    });
                } else {
                    this.setState({
                        surveyList: res.data.map((item) => {
                            return (
                                <div key={item.id}>
                                    <dt style={dtStyle}
                                        onClick={() => this.handleClick(item.id)}>{item.created_at} {item.survey_name}</dt>
                                    <dd style={ddStyle}
                                        onClick={() => this.goToResult(item.id)}
                                    >결과조회
                                    </dd>
                                </div>
                            )
                        })
                    });
                }
            });
    }

    handleClick = (surveyId) => {
        window.location.href += `/${surveyId}`;
    }

    goToResult = (surveyId) => {
        window.location.href += `/${surveyId}/result`;
    }

    render() {
        return (
            <Base>
                <Card header="설문지 리스트">
                    <dl>
                        {this.state.surveyList}
                    </dl>
                </Card>
            </Base>
        );
    }
}

export default SurveyList

// for test
// if (document.getElementById('survey-list')) {
//
//     const surveyForm = document.getElementById('survey-list');
//
//     const props = Object.assign({}, surveyForm.dataset);
//
//     ReactDOM.render(<SurveyList {...props}/>, surveyForm);
// }
