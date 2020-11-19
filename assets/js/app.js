import React from 'react';
import ReactDOM from "react-dom";
import { BrowserRouter as Router, Route, Switch, HashRouter } from "react-router-dom";
import '../css/app.css';
import Navbar from './components/Navbar';
import HomePage from './pages/HomePage';
import PageProduits from "./pages/PageProduits";

// Need jQuery? Install it with "yarn add jquery", then uncomment to import it.
// import $ from 'jquery';

console.log('Hello Webpack Encore! Edit me in assets/js/app.js');

const App = () => {
    return (
      <HashRouter>
        <Navbar />
        <main className="container pt-5">
          <Switch>
            <Route exact path="/produits" component={PageProduits} /> 
            <Route exact path="/" component={HomePage} />
          </Switch>
        </main>
      </HashRouter>
    );
};
    
const rootElement = document.querySelector("#app");
ReactDOM.render(<App />, rootElement);