import React from 'react';
import {ListGroup} from 'react-bootstrap';
import PropTypes from 'prop-types';

export default function Tabs(props) {
    const {onSelection, tabList} = props;
    if (!tabList.data) {
        return (<p>Loading data</p>)
    }
    if (tabList.data.length <= 0) {
        return (<p>Nothing to show</p>)
    }
    return (
        <ListGroup>
            {tabList.data.map(tab =>
                <ListGroup.Item key={tab.id} onClick={() => onSelection(tab.id)}>
                    {tab.customerName}
                </ListGroup.Item>
            )}
        </ListGroup>
    )
}

Tabs.propTypes = {
    onSelection: PropTypes.func.isRequired,
    tabList: PropTypes.object.isRequired
};
