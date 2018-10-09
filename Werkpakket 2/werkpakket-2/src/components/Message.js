import React, { Component } from 'react';
import PropTypes from "prop-types";
import '../styles/MessageCard.css'
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
                <Card shadow={0} style={{ maxWidth: '512px', width: 'auto', margin: 'auto' }}>
                    <CardTitle style={{ color: '#fff', minHeight: '50px', background: 'grey' }}>NAAM</CardTitle>
                    <CardText style={{ textAlign: 'left', minHeight: '100px' }}>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas 
                    consectetur metus sed libero ultrices aliquam. Sed sit amet nisl at 
                    libero imperdiet consectetur. Sed vitae mi turpis. Ut et sapien 
                    condimentum, luctus risus sit amet, accumsan diam. Aliquam erat volutpat. 
                    Sed at augue purus. Mauris vel nulla dictum, consectetur mi ac, 
                    tristique neque.
                    </CardText>
                    <CardActions border style={{ background: 'lightgrey' }}>
                        <Button colored>React -> component reactie</Button>
                        
                    </CardActions>
                </Card>
            </div>
        )
    }
}
export default Message;