import React, { useEffect, useState }  from "react";
import usersAPI from "../services/usersAPI"




 const UsersPage = (props) => {

    const [users, setUsers] = useState([]);

    useEffect(() => {
     usersAPI.findAll()
     .then(data => setUsers(data))
     .catch(error => console.log(error.response));
    }, []);

    const handleDelete = (id) => {
        console.log(id);

        const originalUsers =  [...users];
        //1. L'approche op optimiste
        setUsers(users.filter(user => user.id !== id))
       try {
           usersAPI.delete(id)

       } catch(error){

       }
        //.then(response => console.log("ok"))
        //.catch(error => {
           // si la suppression n'a pas marché je vais remmettre dans mes users mon tableau orignal
           setUsers(originalUsers);
        //  console.log(error.response)
  //  });

    };

    return (
    <>
        <h1>Listes des utilisateurs</h1>

        <table className="table table-hover">
            <thead>
                <tr>
                <th>Id</th>
                <th>Utilisateur</th>
                <th>Email</th>
                <th />
                </tr>
            </thead>
            <tbody>
                {users.map(user =>
                    <tr key={user.id}>
                    <td>{user.id}</td>
                    <td>
                    <a href="#">{user.firstName} {user.lastName}
                    </a>
                    </td>
                    <td>{user.email}</td>
                    <td>
                    <button 
                     onClick={() => handleDelete(user.id)}
                     className="btn btn-sm btn-danger"
                     >
                         Supprimer
                         </button>
                    </td>
                </tr>
                 )}
               
            </tbody>
        </table>
    </>
 );
}

export default UsersPage;
