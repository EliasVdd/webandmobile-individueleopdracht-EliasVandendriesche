import React from 'react';
import PropTypes from 'prop-types';

const ReactionText = (props) => {
    return (<div>
  
        {props.children}
 
    </div>);
};

ReactionText.propTypes = {
    children: PropTypes.node
};

export default ReactionText;    