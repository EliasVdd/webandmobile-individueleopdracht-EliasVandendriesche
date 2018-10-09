import React, { Component } from 'react';
import PropTypes from "prop-types";
import '../styles/MessageCard.css'
import { Button, Card, CardText, CardTitle, CardActions, CardMenu, IconButton } from 'react-mdl';
import  'react-mdl/extra/material.js'
import  'react-mdl/extra/material.css'

const Message = (props) => {
    return (
        <div>
            <Card shadow={0} style={{ maxWidth: '512px', width: 'auto', margin: 'auto', marginTop: '20px' }}>
                <CardTitle style={{ color: '#fff', minHeight: '50px', background: 'grey' }}>
                    Category: {props.messageModel.category}, Upvotes: {props.messageModel.upvotes}, Downvotes: {props.messageModel.downvotes}
                </CardTitle>
                <CardText style={{ textAlign: 'left', minHeight: '100px' }}>
                    {props.messageModel.content}
                </CardText>
                <CardActions border style={{ background: 'lightgrey' }}>
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