import React from "react";
import { Link } from "react-router-dom";

const Navbar = (props) => {
  return (
    <nav className="navbar navbar-expand-lg navbar-light bg-light">
  <a className="navbar-brand" href="#">Gardya-Commerce</a>
  <button className="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
    <span className="navbar-toggler-icon"></span>
  </button>

  <div className="collapse navbar-collapse" id="navbarColor03">
    <ul className="navbar-nav mr-auto">
      <li className="nav-item">
        <a className="nav-link" href="#">Accueil</a>
      </li>
      </ul>
      <ul className="navbar-nav ml-aoto">
        <li className="nav-item">
          <a href="#" className="nav-link">
            Mon compte
          </a>
        </li>
        <li className="nav-item">
          <a href="#" className="nav-link">
            Mon Panier
          </a>
        </li>
      </ul>
      
    <div id="search-bar" class="serach-bar">
    <form className="form-inline my-2 my-lg-0">
      <input className="form-control mr-sm-2" type="text" placeholder="Recherche" />
      <button className="btn btn-secondary my-2 my-sm-0" type="submit">Rechercher</button>
    </form>
    </div>
  </div>
</nav>
  );
};

export default Navbar;




