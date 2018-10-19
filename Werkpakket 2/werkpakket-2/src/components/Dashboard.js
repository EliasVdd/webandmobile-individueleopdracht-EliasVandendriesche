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
                <NavigationBar
                    onSearchContentSubmit={this.onSearchContentSubmit}
                />

                <Switch>
                    <Route exact path='/' component={Welcome} />
                    <Route path='/messageList' component={MessageList} />
                </Switch>
            </div>
        );
    }

    getMessagesWithContent() {
        var content = 'dolor';
        axios.get('http://localhost:8000/messages/find/' + content)
            .then(response => {
                const messages = response.data;
                this.setState({ messages })
            })

    }
}

export default Dashboard;