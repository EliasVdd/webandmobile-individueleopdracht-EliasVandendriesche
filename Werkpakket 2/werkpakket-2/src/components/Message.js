import React, { Component } from 'react';
import PropTypes from "prop-types";
import '../styles/MessageCard.css'
import { Button, Card, CardText, CardTitle, CardActions, CardMenu, IconButton } from 'react-mdl';
import  'react-mdl/extra/material.js'
import  'react-mdl/extra/material.css'

const Message = (props) => {
    return (
        <div>
            <Card shadow={0} style={{ width: '512px', margin: 'auto' }}>
                <CardTitle style={{ color: '#fff', height: '50px', background: 'grey' }}>
                Category: {props.messageModel.category}, Upvotes: {props.messageModel.upvotes}, Downvotes: {props.messageModel.downvotes}
                </CardTitle>
                <CardText>
                {props.messageModel.content}
                </CardText>
                <CardActions border>
                    <Button colored>React -> component reactie</Button>
                    
                </CardActions>
            </Card>
        </div>
    )
}

Message.PropTypes = {
    id: PropTypes.number.isRequired,
    content: PropTypes.string.isRequired,
    category: PropTypes.string.isRequired,
    upvotes: PropTypes.number,
    downvotes: PropTypes.number
}

export default Message;