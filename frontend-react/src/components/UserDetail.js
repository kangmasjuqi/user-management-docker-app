// src/components/UserDetail.js
import React, { useState, useEffect } from 'react';
import { useParams, Link } from 'react-router-dom';
import { useAuth } from '../contexts/AuthContext';
import axios from 'axios';

function UserDetail() {
  const [user, setUser] = useState(null);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState('');
  const { id } = useParams();
  const { apiUrl } = useAuth();

  useEffect(() => {
    const fetchUser = async () => {
      try {
        const response = await axios.get(`/api/users/${id}`);
        setUser(response.data);
      } catch (err) {
        setError('Failed to load user details');
      } finally {
        setLoading(false);
      }
    };

    fetchUser();
  }, [id, apiUrl]);

  if (loading) return <div className="loading">Loading...</div>;
  if (error) return <div className="error">{error}</div>;
  if (!user) return <div className="error">User not found</div>;

  const formatLevel = (level) => {
    return level.replace('_', ' ').split(' ').map(word => 
      word.charAt(0).toUpperCase() + word.slice(1)
    ).join(' ');
  };

  return (
    <div className="user-detail">
      <Link to="/users" className="back-link">← Back to Users</Link>
      
      <div className="user-header">
        <div className="user-avatar-large">
          {user.fullname.charAt(0).toUpperCase()}
        </div>
        <div className="user-basic-info">
          <h1>{user.fullname}</h1>
          <p className="user-username">@{user.username}</p>
          <div className="user-meta">
            <span className="meta-item">📧 {user.email}</span>
            <span className="meta-item">📱 {user.phone}</span>
            <span className="meta-item">👤 {user.gender.charAt(0).toUpperCase() + user.gender.slice(1)}</span>
          </div>
        </div>
      </div>

      <div className="educations-section">
        <h2>Education History ({user.educations.length})</h2>
        {user.educations.length === 0 ? (
          <p className="no-data">No education records found.</p>
        ) : (
          <div className="educations-timeline">
            {user.educations
              .sort((a, b) => a.year - b.year)
              .map(education => (
              <div key={education.id} className="education-card">
                <div className="education-year">{education.year}</div>
                <div className="education-content">
                  <h3 className="education-level">{formatLevel(education.level)}</h3>
                  <p className="education-institution">{education.institution}</p>
                  {education.major && (
                    <p className="education-major">Major: {education.major}</p>
                  )}
                  {education.gpa && (
                    <p className="education-gpa">GPA: {education.gpa}/4.0</p>
                  )}
                </div>
              </div>
            ))}
          </div>
        )}
      </div>
    </div>
  );
}

export default UserDetail;