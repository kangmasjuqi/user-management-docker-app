// src/components/Navigation.js
import React from 'react';
import { Link, useNavigate } from 'react-router-dom';
import { useAuth } from '../contexts/AuthContext';

function Navigation() {
  const { token, logout } = useAuth();
  const navigate = useNavigate();

  const handleLogout = async () => {
    await logout();
    navigate('/login');
  };

  return (
    <nav className="navbar">
      <div className="nav-container">
        <Link to="/" className="nav-brand">UserApp</Link>
        {token && (
          <ul className="nav-menu">
            <li><Link to="/dashboard" className="nav-link">Dashboard</Link></li>
            <li><Link to="/users" className="nav-link">Users</Link></li>
            <li><button onClick={handleLogout} className="nav-button">Logout</button></li>
          </ul>
        )}
      </div>
    </nav>
  );
}

export default Navigation;