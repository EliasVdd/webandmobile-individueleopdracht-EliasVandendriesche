import React, { Component } from 'react';
import './Message';
import Message from './Message';
import axios from 'axios';


class MessageList extends Component {
    constructor(props) {
        super(props);
        this.state = {
            messages: [],
            reactionModels: [],
            reactionModelToAdd: {
                messageId:0,
                reactionContent:''                   
            }
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

    onReactionTextfieldChanged = (event, messageId) => {
        const newReaction = event.target.value;
        const modelToUpdate = this.state.reactionModelToAdd;

        if (newReaction) {
            modelToUpdate.reactionContent = newReaction;
            modelToUpdate.messageId = messageId;
        } else {
            modelToUpdate.reactionContent = '';
        }

        this.setState({ reactionModelToAdd: modelToUpdate });
    }

    reactToComment = () => {
        if (this.state.reactionModelToAdd.reactionContent.trim()) {
            this.setState({
                reactionModels: [...this.state.reactionModels, this.state.reactionModelToAdd]
            });
        }
        this.setState({
            reactionModelToAdd: {
                messageId: 0,
                reactionContent: ''
            }
        });
    }
    renderMessages() {
        return this.state.messages.map(message => 
            (
                <Message key={message.id} data-key={message.id} reactionModels={this.state.reactionModels} reactToComment={this.reactToComment} reactionModelToAdd={this.reactionModelToAdd} onReactionTextfieldChanged={this.onReactionTextfieldChanged} messageModel={message} onClickDownvote={this.onClickDownvote} onClickUpvote={this.onClickUpvote}></Message>
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