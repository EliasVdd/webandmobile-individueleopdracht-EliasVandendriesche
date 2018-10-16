import React, { Component } from 'react';
import './Message';
import Message from './Message';


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

    onReactionTextfieldChanged = (event) => {
        const newReaction = event.target.value;
        const modelToUpdate = this.state.reactionModelToAdd;

        if (newReaction) {
            modelToUpdate.reactionContent = newReaction;
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
                <Message reactionModels={this.state.reactionModels} reactToComment={this.reactToComment} reactionModelToAdd={this.reactionModelToAdd} messageModel={message} onClickDownvote={this.onClickDownvote} onClickUpvote={this.onClickUpvote}></Message>
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