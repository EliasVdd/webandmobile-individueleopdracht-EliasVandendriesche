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
                <div>
                    <Card shadow={0} style={{ maxWidth: '512px', width: 'auto', margin: 'auto', marginTop: '20px', marginBottom: '20px' }}>
                        <CardTitle style={{ color: '#fff', minHeight: '50px', height: 'auto', background: 'grey' }}>
                            Category: {message.category}, Upvotes: {message.upvotes}, Downvotes: {message.downvotes}
                        </CardTitle>
                        <CardText style={{ textAlign: 'left', minHeight: '100px' }}>
                            {message.content}
                        </CardText>
                        <CardActions border style={{ background: 'lightgrey' }}>
                            <div style={{ float: 'left', width: '60%' }}>
                                <Textfield onChange={() => { }} label="Reaction content..." rows={3} style={{ width: 'parent' }} />
                                <p><Button raised ripple style={{ float: 'right' }}>Place reaction</Button></p>
                            </div>
                            <div style={{ float: 'right', width: '40%' }}>
                                <p style={{ textAlign: 'right' }}>
                                    <FABButton raised ripple onClick={() => this.onClickUpvote(message.id)}>
                                        <Icon name="thumb_up_alt" />
                                    </FABButton>
                                </p>
                                <p style={{ textAlign: 'right' }}>
                                    <FABButton raised ripple onClick={() => this.onClickDownvote(message.id)}>
                                        <Icon name="thumb_down_alt" />
                                    </FABButton>
                                </p>
                            </div>
                        </CardActions>
                    </Card>
                </div>
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