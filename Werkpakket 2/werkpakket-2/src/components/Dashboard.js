import React, { Component } from 'react';
import MessageList from './MessageList.js';
import NavigationBar from './NavigationBar.js';
import Welcome from './Welcome.js';
import { Switch, Route } from 'react-router-dom';
import axios from 'axios';

class Dashboard extends Component {
    state = {
        
    }

    render() {
        return (
            <div className="App">
                <Route exact path='/' component={Welcome} />
                <Route path='/messageList' component={MessageList} />
            </div>
        );
    }
}

export default Dashboard;