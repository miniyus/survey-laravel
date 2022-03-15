import {Component} from 'react';
import {LOCALE} from "../../config";
import 'survey-react/modern.min.css';
import {Survey, StylesManager, Model} from 'survey-react';
import Card from "../layouts/Card";
import Base from "../layouts/Base";
import axios from "axios";

StylesManager.applyTheme("modern");

class SurveyForm extends Component {
    static defaultProps = {
        locale: LOCALE,
        surveyId: 0
    }

    constructor(props) {
        super(props);
        this.state = {
            model: new Model({})
        }
    }

    componentDidMount() {
        this.getDataFromApi(this.props.surveyId);
    }

    handleComplete = (sender) => {
        const surveyId = this.props.surveyId;
        console.log(JSON.stringify(sender.data));
        axios.post(`/api/survey/${surveyId}/result`, {
            data: sender.data
        })
            .then((res) => {
                console.log('created survey result: ' + res.data.id);
                window.location.href = `/survey/${this.props.surveyId}/result/${res.data.id}`;
            });
    }

    getDataFromApi = (surveyId) => {
        axios.get(`/api/survey/${surveyId}`)
            .then((res) => {
                console.log('get survey json: ' + JSON.stringify(res.data));
                this.setState({
                    model: new Model(res.data.survey_json)
                });

                this.state.model.locale = this.props.locale;
                this.state.model.onComplete.add(this.handleComplete);
            });
    }

    render() {
        return (
            <Base>
                <Card header="설문지">
                    <Survey model={this.state.model}/>
                </Card>
            </Base>
        );
    }
}

export default SurveyForm

// for test
// if (document.getElementById('survey-form')) {
//
//     const surveyForm = document.getElementById('survey-form');
//
//     const props = Object.assign({}, surveyForm.dataset);
//
//     ReactDOM.render(<SurveyForm {...props}/>, surveyForm);
// }
