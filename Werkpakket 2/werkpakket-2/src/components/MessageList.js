import React, { Component } from 'react';
import { Button, Card, CardText, CardTitle, CardActions, Textfield, FABButton, Icon } from 'react-mdl';
import PropTypes from "prop-types";
import './Message';
import Message from './Message';


class MessageList extends Component {
    constructor(props) {
        super(props);
        this.state = {
            messages: [],
            upvotes: []
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

    onClickUpvote = (id) => {
        fetch('http://localhost:8000/message/upvote/' + id, {
            method: 'POST'
        });
        fetch('http://localhost:8000/message/' + id)
        .then(response => {
            return response.json();
        })
        .then(message => {
            const updatedMessages = Array.from(this.state.messages);
            updatedMessages[id - 1] = message;
            this.setState({messages: updatedMessages});
        })
    }

    onClickDownvote = (id) => {
        fetch('http://localhost:8000/message/downvote/' + id, {
            method: 'POST'
        });
        fetch('http://localhost:8000/message/' + id)
        .then(response => {
            return response.json();
        })
        .then(message => {
            const updatedMessages = Array.from(this.state.messages);
            updatedMessages[id - 1] = message;
            this.setState({messages: updatedMessages});
        })
    }

    renderMessages() {
        return this.state.messages.map(message => 
            (
                <Message messageModel={message} onClickDownvote={this.onClickDownvote} onClickUpvote={this.onClickUpvote}></Message>
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