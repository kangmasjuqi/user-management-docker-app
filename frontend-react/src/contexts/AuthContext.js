import React, { createContext, useContext, useState, useEffect } from 'react';
import axios from 'axios';

const AuthContext = createContext();

export function useAuth() {
  return useContext(AuthContext);
}

export function AuthProvider({ children }) {
  const [user, setUser] = useState(null);
  const [loading, setLoading] = useState(true);
  const [token, setToken] = useState(localStorage.getItem('token'));

  const apiUrl = process.env.REACT_APP_API_URL || 'http://localhost:8000';

  // Axios config
  useEffect(() => {
    axios.defaults.baseURL = apiUrl;

    if (token) {
      axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
    } else {
      delete axios.defaults.headers.common['Authorization'];
    }

    const fetchUser = async () => {
      if (!token) {
        setLoading(false);
        return;
      }

      try {
        const response = await axios.get('/api/user');
        setUser(response.data);
      } catch (error) {
        console.error('Error fetching user:', error);
        setUser(null);
        localStorage.removeItem('token');
      } finally {
        setLoading(false);
      }
    };

    fetchUser();
  }, [token, apiUrl]);

  const login = async (username, password) => {
    const response = await axios.post('/api/login', { username, password });

    const { access_token, user } = response.data;

    setToken(access_token);
    setUser(user);
    localStorage.setItem('token', access_token);
    axios.defaults.headers.common['Authorization'] = `Bearer ${access_token}`;

    return response.data;
  };

  const register = async (userData) => {
    const response = await axios.post('/api/register', userData);

    const { access_token, user } = response.data;

    setToken(access_token);
    setUser(user);
    localStorage.setItem('token', access_token);
    axios.defaults.headers.common['Authorization'] = `Bearer ${access_token}`;

    return response.data;
  };

  const logout = async () => {
    try {
      await axios.post('/api/logout');
    } catch (err) {
      console.error('Logout failed:', err);
    }

    setUser(null);
    setToken(null);
    localStorage.removeItem('token');
    delete axios.defaults.headers.common['Authorization'];
  };

  const value = {
    user,
    token,
    login,
    register,
    logout,
    loading,
  };

  return (
    <AuthContext.Provider value={value}>
      {!loading && children}
    </AuthContext.Provider>
  );
}
