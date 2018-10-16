import React from 'react';
import { Card, CardText, CardTitle, CardActions, FABButton, Icon,List, ListItem, ListItemContent } from 'react-mdl';
import PropTypes from "prop-types";
import  'react-mdl/extra/material.js'
import  'react-mdl/extra/material.css'
import AddReaction from './AddReaction.js'
import ReactionText from './ReactionText'

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
            <ReactionText>
                    {props.reactionModels.length ?
                        
                        <div>
                            {props.reactionModels.filter(r => r.messageId === props.messageModel.id).map(reactionModel => 
                                <List style={{width: '650px'}}>
                                <ListItem threeLine>
                                  <ListItemContent avatar="person" subtitle={reactionModel.reactionContent}>{reactionModel.messageId}</ListItemContent>   
                                  </ListItem>
                                  </List>
                                )}
                        </div> :
                        <CardText>
                            
                            NO REACTION
                           
                        </CardText>
                        
                    }
                    </ReactionText>
                            <AddReaction 
                            onReactionTextfieldChanged={(e) => props.onReactionTextfieldChanged(e, props.messageModel.id)}
                            reactionModelToAdd={props.reactionModelToAdd}
                            reactToComment={props.reactToComment}>
                            </AddReaction>
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
    onClickUpvote: PropTypes.func.isRequired,
    messageId: PropTypes.number.isRequired,
    reactionContent: PropTypes.string.isRequired,
    reactToComment: PropTypes.func.isRequired,
    onReactionTextfieldChanged: PropTypes.func.isRequired,
    reactionModelToAdd: PropTypes.array.isRequired
}

export default Message;