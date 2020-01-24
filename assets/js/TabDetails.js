import React from 'react';
import PropTypes from 'prop-types';
import {Button, Card, ListGroup} from "react-bootstrap";

export default function TabDetails(props){
    const { tabDetails, menuList, onAddToTab } = props;
    if (!tabDetails.data) {
        return (<p>Loading Data</p>)
    }
    return (<div className="tabdetails">
        <Card className="centeralign">
            <Card.Header as="h3">
                {tabDetails.data.customer}
            </Card.Header>
            <Card.Body>
                <p>Id : {tabDetails.data.id}</p>
                <p>Tab opened on : {tabDetails.data.opened_on}</p>
            </Card.Body>
            <ListGroup>
                {menuList.data.map(item =>
                    <Button variant="secondary" onClick={() => onAddToTab(tabDetails.data.id, item)}>
                        Add a {item}
                    </Button>
                )}
            </ListGroup>
        </Card>
    </div>)
}

TabDetails.propTypes = {
    tabDetails: PropTypes.object.isRequired,
    menuList: PropTypes.object.isRequired,
    onAddToTab: PropTypes.func.isRequired
};
