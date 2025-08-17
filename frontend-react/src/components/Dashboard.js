// src/components/Dashboard.js
import React, { useState, useEffect } from 'react';
import { useAuth } from '../contexts/AuthContext';
import axios from 'axios';

function Dashboard() {
  const [stats, setStats] = useState(null);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState('');
  const [notifStatus, setNotifStatus] = useState('');
  const { apiUrl } = useAuth();

  useEffect(() => {
    const fetchStats = async () => {
      try {
        const response = await axios.get('/api/dashboard');
        setStats(response.data);
      } catch (err) {
        setError('Failed to load dashboard data');
      } finally {
        setLoading(false);
      }
    };

    fetchStats();
  }, [apiUrl]);

  const handleSendNotif = async () => {
    try {
      setNotifStatus('Sending...');
      await axios.post('/api/sendNotif');
      setNotifStatus('✅ Notifications sent successfully');
    } catch (err) {
      setNotifStatus('❌ Failed to send notifications');
    }
  };

  if (loading) return <div className="loading">Loading...</div>;
  if (error) return <div className="error">{error}</div>;

  return (
    <div className="dashboard">
      <h1>Dashboard</h1>

        <div className="actions mb-2">
            <button 
                onClick={handleSendNotif} 
                className="btn-send-notif"
            >
                Send Bulk Notif
            </button>
            {notifStatus && <p>{notifStatus}</p>}
        </div>
      
      <div className="stats-grid">
        <div className="stat-card">
          <h3>Total Users</h3>
          <p className="stat-number">{stats.total_users}</p>
        </div>
        
        <div className="stat-card">
          <h3>Recent Registrations</h3>
          <p className="stat-number">{stats.recent_registrations}</p>
          <small>Last 30 days</small>
        </div>
      </div>

      <div className="charts-grid">
        <div className="chart-card">
          <h3>Gender Distribution</h3>
          <div className="chart-data">
            {stats.gender_distribution.map(item => (
              <div key={item.gender} className="chart-item">
                <span className="label">{item.gender.charAt(0).toUpperCase() + item.gender.slice(1)}</span>
                <span className="value">{item.count}</span>
                <div className="bar">
                  <div 
                    className="bar-fill" 
                    style={{width: `${(item.count / stats.total_users) * 100}%`}}
                  ></div>
                </div>
              </div>
            ))}
          </div>
        </div>

        <div className="chart-card">
          <h3>Education Levels</h3>
          <div className="chart-data">
            {stats.education_levels.map(item => (
              <div key={item.level} className="chart-item">
                <span className="label">{item.level.replace('_', ' ').charAt(0).toUpperCase() + item.level.replace('_', ' ').slice(1)}</span>
                <span className="value">{item.count}</span>
                <div className="bar">
                  <div 
                    className="bar-fill" 
                    style={{width: `${(item.count / Math.max(...stats.education_levels.map(e => e.count))) * 100}%`}}
                  ></div>
                </div>
              </div>
            ))}
          </div>
        </div>
      </div>
    </div>
  );
}

export default Dashboard;
