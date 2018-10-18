import React, { Component } from 'react';
import './Message';
import Message from './Message';
import axios from 'axios';
import AddReaction from './AddReaction.js'
import ReactionText from './ReactionText'
import { List, ListItem, ListItemContent } from 'react-mdl';

class MessageList extends Component {
    constructor(props) {
        super(props);
        this.state = {
            messages: [],
            reactions: [],
            reactionModelToAdd: {
                messageId: 0,
                content: ''
            }
        }
    }
    
    componentDidMount() {
        axios.get('http://localhost:8000/messages')
        .then(response => {
            const messages = response.data;
            this.setState({ messages });
        });
        axios.get('http://localhost:8000/reactions')
        .then(response => {
            const reactions = response.data;
            this.setState({ reactions });
        });
    }
    
    onClickUpvote = (id) => {
        axios.post('http://localhost:8000/message/upvote/' + id)
        .then(response => {
            const reactions = response.data;
            this.setState({ reactions });
        });
    }
    
    onClickDownvote = (id) => {
        axios.post('http://localhost:8000/message/downvote/' + id);
        axios.get('http://localhost:8000/message/' + id)
        .then(response => {
            const updatedMessages = Array.from(this.state.messages);
            updatedMessages[id - 1] = response.data;
            this.setState({ messages: updatedMessages });
        });
    }
    
    onReactionTextfieldChanged = (event, messageId) => {
        const newReaction = event.target.value;
        const modelToUpdate = this.state.reactionModelToAdd;
        
        if (newReaction) {
            modelToUpdate.content = newReaction;
            modelToUpdate.messageId = messageId;
        } else {
            modelToUpdate.content = '';
        }
        
        this.setState({ reactionModelToAdd: modelToUpdate });
    }
    
    reactToComment = () => {
        if (this.state.reactionModelToAdd.content.trim()) {
            axios.post('http://localhost:8000/reaction/' + this.state.reactionModelToAdd.messageId + '/' + this.state.reactionModelToAdd.content);
            axios.get('http://localhost:8000/reactions/')
            .then(response => {
                const updatedReactions = Array.from(this.state.reactions);
                updatedReactions = response.data;
                this.setState({ reactions: updatedReactions });
            });
        }
        this.setState({
            reactionModelToAdd: {
                messageId: 0,
                content: ''
            }
        });
    }

    renderMessages() {
        return this.state.messages.map(message =>
            (
                <Message key={message.id} data-key={message.id} reactions={this.state.reactions} reactToComment={this.reactToComment} reactionModelToAdd={this.reactionModelToAdd} onReactionTextfieldChanged={this.onReactionTextfieldChanged} messageModel={message} onClickDownvote={this.onClickDownvote} onClickUpvote={this.onClickUpvote}></Message>
                ),
                )
            }
            
            render() {
                return (
                    this.renderMessages()
                    );
                }
            }
            
            export default MessageList;