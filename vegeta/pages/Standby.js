import {  Page } from "@shopify/polaris";
import { ResourcePicker } from "@shopify/app-bridge-react";

var collection_id;

class Index extends React.Component {
    constructor(props) {
    super(props);
    this.state = {name: '', message: '', email: ''};
    this.handleChange = this.handleChange.bind(this);
    this.handleSubmit = this.handleSubmit.bind(this);
    }
    handleChange(key) {
        return function (e) {
            var state = {};
            state[key] = e.target.value;
            this.setState(state);
        }.bind(this);
    }
    handleSubmit(event) {
        var data = {
            start_date: this.state.start_date,
            start_time: this.state.start_time,
            end_date: this.state.end_date,
            end_time: this.state.end_time
        }
        var json_date = JSON.stringify(data);
        console.log(json_date);
        event.preventDefault();
    }
    render () {
        return (
            <Page
                title='Collect Selector'
                primaryAction={{
                    content: 'Select collections',
                   onAction: () => this.setState({open: true})
                }}
                >
               <form onSubmit={this.handleSubmit}>
                    <label>
                        Start: <br />
                        <input type="date" autoComplete="" value={this.state.start_date} onChange={this.handleChange('start_date')} />
                        <input type="time" autoComplete="" value={this.state.start_time} onChange={this.handleChange('start_time')} />
                    </label>
                    <br />
                    <label>
                        End:<br />
                        <input type="date" autoComplete="" value={this.state.end_date} onChange={this.handleChange('end_date')} />
                        <input type="time" autoComplete="" value={this.state.end_time} onChange={this.handleChange('end_time')} />
                    </label>
                    <br />
                    <input type="submit" value="Submit" />
                </form>
            <ResourcePicker
                resourceType='Collection'
                open={this.state.open}
                onCancel={() => this.setState({open: false})}
                onSelection={(resources) => this.handleSelection(resources)}
            />
            </Page>
        )
    }
    handleSelection = (resources) => {
        const idFromResources = resources.selection.map((Collection) => Collection.id);
        this.setState({open: false})
        console.log(idFromResources);
        var str = idFromResources + '', arr = str.split('/');
        collection_id = arr[4];

        var tab = [{Collection_id: collection_id}];
        var json_tab = JSON.stringify(tab);
        console.log(json_tab);
    }

}

export default Index;

