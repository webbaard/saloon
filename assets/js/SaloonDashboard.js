import React, {Component} from 'react';
import Tabs from './Tabs';
import TabDetails from './TabDetails';
import OpenTabForm from './OpenTabForm';
import axios from "axios/index";

export default class SaloonDashboard extends Component {

    constructor(props) {
        super(props);
        this.state = {
            tabList: {},
            menuList: {},
            tabDetails: {}
        };

        this.onSelection = this.onSelection.bind(this);
        this.onOpenTabSubmit = this.onOpenTabSubmit.bind(this);
    }

    componentDidMount() {
        this.getTabsData();
        this.getMenuData();
    }

    getTabsData() {
        axios.get('/tabs/list.json').then(response => {
            this.setState({tabList: response})
        })
    }

    getMenuData() {
        axios.get('/menu/list.json').then(response => {
            this.setState({menuList: response})
        })
    }

    onSelection(id) {
        if (id === "") {
            return;
        }
        axios.get('/tab/' + id + '.json').then(response => {
            this.setState({tabDetails: response})
        })
    }

    onOpenTabSubmit(customerName) {
        axios.post('/api/commands/open-tab', JSON.stringify({
            'customerName' : customerName,
        }));
        this.getTabsData();
    }

    onAddToTab(id, order) {
        axios.post('/api/commands/add-to-tab', JSON.stringify({
            'id' : id,
            'order' : order
        }));
        this.getTabsData();
        this.onSelection();
    }

    render() {
        const { tabList, tabDetails, menuList } = this.state;
        return (<div className="row">
            <div className="col-lg-5 order-first order-lg-first order-sm-last">
                <Tabs
                    tabList={tabList}
                    onSelection={this.onSelection}
                />
            </div>
            <div className="col-lg-4">
                <TabDetails
                    tabDetails={tabDetails}
                    menuList={menuList}
                    onAddToTab={this.onAddToTab}
                />
            </div>
            <div className="col-lg-3 order-last order-lg-last order-sm-first">
                <OpenTabForm
                    onOpenTabSubmit={this.onOpenTabSubmit}
                />
            </div>
        </div>)
    }
}