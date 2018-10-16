import React, { Component } from 'react';
import './Message';
import Message from './Message';
import axios from 'axios';


class MessageList extends Component {
    constructor(props) {
        super(props);
        this.state = {
            messages: [],
            upvotes: []
        }
    }

    componentDidMount() {
        axios.get('http://localhost:8000/messages')
        .then(response => {
            const messages = response.data;
            this.setState({ messages });
        });
    }

    onClickUpvote = (id) => {
        axios.post('http://localhost:8000/message/upvote/' + id);
        axios.get('http://localhost:8000/message/' + id)
        .then(response => {
            const updatedMessages = Array.from(this.state.messages);
            updatedMessages[id - 1] = response.data;
            this.setState({messages: updatedMessages});
        });
    }

    onClickDownvote = (id) => {
        axios.post('http://localhost:8000/message/downvote/' + id);
        axios.get('http://localhost:8000/message/' + id)
        .then(response => {
            const updatedMessages = Array.from(this.state.messages);
            updatedMessages[id - 1] = response.data;
            this.setState({messages: updatedMessages});
        });
    }

    renderMessages() {
        return this.state.messages.map(message => 
            (
                <Message key={message.id} messageModel={message} onClickDownvote={this.onClickDownvote} onClickUpvote={this.onClickUpvote}></Message>
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