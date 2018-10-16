import React, { Component } from 'react';
import './App.css';
import MessageList from './components/MessageList.js';
import NavigationBar from './components/NavigationBar.js';

class App extends Component {
  render() {
    return (
      <div className="App">
        <NavigationBar/>
        <MessageList />
      </div>
    );
  }
}

export default App;
