import React, { Component } from 'react';
import { Button, Card, CardText, CardTitle, CardActions, Textfield, FABButton, Icon } from 'react-mdl';
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
                                    <FABButton raised ripple onClickUpvote={this.onClickUpvote}>
                                        <Icon name="exposure_plus_1" />
                                    </FABButton>
                                </p>
                                <p style={{ textAlign: 'right' }}>
                                    <FABButton raised ripple>
                                        <Icon name="exposure_neg_1" />
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