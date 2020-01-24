import React, { Component } from 'react';
import { render} from 'react-dom';
import logo from '../media/hat.png';
import '../css/App.css';
import { BrowserRouter as Router, Switch, Route} from 'react-router-dom';
import SaloonDashboard from "./SaloonDashboard";

class App extends Component {
    render() {
        return (
            <Router basename={process.env.PUBLIC_URL}>
                <div className="App">
                    <header className="App-header">
                        <img src={logo} className="App-logo" alt="logo" />
                        <h1 className="App-title">Saloon</h1>
                    </header>
                    <Switch>
                        <Route exact path='/' component={SaloonDashboard} />
                    </Switch>
                </div>
            </Router>
        );
    }
}

render(<App />, document.getElementById('root'));