import React, {Component} from 'react';
import Form from 'react-bootstrap/Form';
import Button from 'react-bootstrap/Button';
import PropTypes from "prop-types";

export default class OpenTabForm extends Component {

    constructor(props) {
        super(props);
        this.customerNameInput = React.createRef();

        this.handleSubmit = this.handleSubmit.bind(this);
    }

    handleSubmit (event) {
        event.preventDefault();
        const { onOpenTabSubmit } = this.props;
        const customerNameInput = this.customerNameInput.current;

        onOpenTabSubmit(
            customerNameInput.value,
        );
    }

    render() {
        return (<div className="openTab">
            <Form onSubmit={this.handleSubmit}>
                <Form.Group controlId="customerName">
                    <Form.Label>Customer Name</Form.Label>
                    <Form.Control type="text" ref={this.customerNameInput} placeholder="Enter customer name"/>
                    <Form.Text className="text-muted">
                    </Form.Text>
                </Form.Group>
                <Button type="submit">
                    Submit
                </Button>
            </Form>
        </div>)
    }
}

OpenTabForm.propTypes = {
    onOpenTabSubmit: PropTypes.func.isRequired,
};
