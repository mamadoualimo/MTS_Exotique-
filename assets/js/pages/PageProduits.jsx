import React, {useEffect, useState } from 'react';
import axios from "axios";

const PageProduits = props => {
    const [produits, setProduits] = useState([]);

    useEffect(() => {
       axios
         .get("https://localhost:8000/api/produits")
         .then(response => response.data['hydra:member']);
         .then(data => setProduits(data));
         .catch(error => console.log(error.response));
   }, []);

    return (
       <>
         <h1> Liste des produits</h1>
         <table className="table table-hover">
            <thead>
               <tr>
                  <th>Id.</th>
                  <th>Nom</th>
                  <th>Description</th>
                  <th>Image</th>
                  <th>Categorie</th>
                  <th>Prix</th>
                  <th />
               </tr>
            </thead>
         </table>
         <tbody>
            {produits.map(produit => (
               <tr key={produit.id}>
                  <td>{produit.id}</td>
                  <td>
                     <a href="#">
                        {produit.firstName} {produit.}
                     </a>
                  </td>
            ))}
         </tbody>
export default PageProduits;