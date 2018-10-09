import React, { Component } from 'react';
import PropTypes from "prop-types";
import './Message';
import Message from './Message';


class MessageList extends Component {
    constructor(props) {
        super(props);
        this.state = {
            messages: []
        }
    }

    componentDidMount() {
        fetch('http://localhost:8000/messages')
        .then(response => {
            return response.json();
        })
        .then(messages=>{
            this.setState({messages});
        });
    }

    renderMessages() {
        return this.state.messages.map(message => 
            (
                <Message
                messageModel={message}/>
            ),
        )
    }

    render() {
        return(
            this.renderMessages()
        );
    }
}

export default MessageList;