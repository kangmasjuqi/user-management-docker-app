// src/components/UserList.js
import React, { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import { useAuth } from '../contexts/AuthContext';
import axios from 'axios';

function UserList() {
  const [users, setUsers] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState('');
  const { apiUrl } = useAuth();

  useEffect(() => {
    const fetchUsers = async () => {
      try {
        const response = await axios.get('/api/users');
        setUsers(response.data.data);
      } catch (err) {
        setError('Failed to load users');
      } finally {
        setLoading(false);
      }
    };

    fetchUsers();
  }, [apiUrl]);

  if (loading) return <div className="loading">Loading...</div>;
  if (error) return <div className="error">{error}</div>;

  return (
    <div className="user-list">
      <h1>Users</h1>
      <div className="users-grid">
        {users.map(user => (
          <div key={user.id} className="user-card">
            <div className="user-avatar">
              {user.fullname.charAt(0).toUpperCase()}
            </div>
            <div className="user-info">
              <h3>{user.fullname}</h3>
              <p className="user-username">@{user.username}</p>
              <p className="user-email">{user.email}</p>
              <p className="user-phone">{user.phone}</p>
              <p className="user-gender">{user.gender.charAt(0).toUpperCase() + user.gender.slice(1)}</p>
              <p className="education-count">{user.educations.length} education(s)</p>
              <Link to={`/users/${user.id}`} className="btn btn-primary">
                View Details
              </Link>
            </div>
          </div>
        ))}
      </div>
    </div>
  );
}

export default UserList;