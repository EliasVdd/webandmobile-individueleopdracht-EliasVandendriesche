import React, { Component } from 'react';
import { Button, Card, CardText, CardTitle, CardActions, FABButton, Textfield, Icon } from 'react-mdl';
import PropTypes from "prop-types";
import  'react-mdl/extra/material.js'
import  'react-mdl/extra/material.css'

const Message = (props) => {
    return (
        <div>
        <Card shadow={0} style={{ maxWidth: '512px', width: 'auto', margin: 'auto', marginTop: '20px', marginBottom: '20px' }}>
            <CardTitle style={{ color: '#fff', minHeight: '50px', height: 'auto', background: 'grey' }}>
                Category: {props.messageModel.category}, Upvotes: {props.messageModel.upvotes}, Downvotes: {props.messageModel.downvotes}
            </CardTitle>
            <CardText style={{ textAlign: 'left', minHeight: '100px' }}>
                {props.messageModel.content}
            </CardText>
            <CardActions border style={{ background: 'lightgrey' }}>
                <div style={{ float: 'left', width: '60%' }}>
                    <Textfield onChange={() => { }} label="Reaction content..." rows={3} style={{ width: 'parent' }} />
                    <p><Button raised ripple style={{ float: 'right' }}>Place reaction</Button></p>
                </div>
                <div style={{ float: 'right', width: '40%' }}>
                    <p style={{ textAlign: 'right' }}>
                        <FABButton raised ripple onClick={() => props.onClickUpvote(props.messageModel.id)}>
                            <Icon name="thumb_up_alt" />
                        </FABButton>
                    </p>
                    <p style={{ textAlign: 'right' }}>
                        <FABButton raised ripple onClick={() => props.onClickDownvote(props.messageModel.id)}>
                            <Icon name="thumb_down_alt" />
                        </FABButton>
                    </p>
                </div>
            </CardActions>
        </Card>
    </div>
    );
}

Message.PropTypes = {
    id: PropTypes.number.isRequired,
    content: PropTypes.string.isRequired,
    category: PropTypes.string.isRequired,
    upvotes: PropTypes.number,
    downvotes: PropTypes.number,
    onClickDownvote: PropTypes.func.isRequired,
    onClickUpvote: PropTypes.func.isRequired
}

export default Message;