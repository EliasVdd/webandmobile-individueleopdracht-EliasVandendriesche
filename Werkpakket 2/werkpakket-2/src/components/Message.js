import React, { Component } from 'react';
import PropTypes from "prop-types";
import '../Styles/MessageCard.css'
import { Button, Card, CardText, CardTitle, CardActions, CardMenu, IconButton } from 'react-mdl';
import  'react-mdl/extra/material.js'
import  'react-mdl/extra/material.css'
class Message extends Component {
    constructor(props) {
        super(props);

        this.state =
            {
                messageModels: [],
                messageModelToAdd: {
                    content: '',
                    category: '',
                    upvotes: 0,
                    downvotes: 0
                }
            };
    }

    render() {
        return (
            <div>
                <Card shadow={0} style={{ width: '512px', margin: 'auto' }}>
                    <CardTitle style={{ color: '#fff', height: '50px', background: 'grey' }}>NAAM</CardTitle>
                    <CardText>
                       messagePOST
                    </CardText>
                    <CardActions border>
                        <Button colored>React -> component reactie</Button>
                        
                    </CardActions>
                </Card>
            </div>
        )
    }
}
export default Message;