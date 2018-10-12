import React, { Component } from 'react';
import PropTypes from "prop-types";
import '../styles/MessageCard.css'
import  'react-mdl/extra/material.js'
import  'react-mdl/extra/material.css'

const Message = (props) => {
    
}

Message.PropTypes = {
    id: PropTypes.number.isRequired,
    content: PropTypes.string.isRequired,
    category: PropTypes.string.isRequired,
    upvotes: PropTypes.number,
    downvotes: PropTypes.number
}

export default Message;