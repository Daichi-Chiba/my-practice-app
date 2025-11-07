// Lesson 05: API連携 (fetch, データ取得)

import { useState, useEffect } from 'react';

function Lesson05() {
  const [users, setUsers] = useState([]);
  const [posts, setPosts] = useState([]);
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState(null);
  const [selectedUser, setSelectedUser] = useState(null);

  // ユーザーデータの取得
  useEffect(() => {
    fetchUsers();
  }, []);

  const fetchUsers = async () => {
    setLoading(true);
    setError(null);

    try {
      const response = await fetch('https://jsonplaceholder.typicode.com/users');
      if (!response.ok) {
        throw new Error('データの取得に失敗しました');
      }
      const data = await response.json();
      setUsers(data);
    } catch (err) {
      setError(err.message);
    } finally {
      setLoading(false);
    }
  };

  // 特定ユーザーの投稿を取得
  const fetchUserPosts = async (userId) => {
    setLoading(true);
    setError(null);
    setSelectedUser(userId);

    try {
      const response = await fetch(`https://jsonplaceholder.typicode.com/posts?userId=${userId}`);
      if (!response.ok) {
        throw new Error('投稿の取得に失敗しました');
      }
      const data = await response.json();
      setPosts(data.slice(0, 5)); // 最初の5件のみ表示
    } catch (err) {
      setError(err.message);
      setPosts([]);
    } finally {
      setLoading(false);
    }
  };

  return (
    <div style={{ padding: '2rem' }}>
      <h1 style={{ color: '#667eea', marginBottom: '1rem' }}>Lesson 05: API連携</h1>

      <p style={{ marginBottom: '2rem', color: '#666' }}>
        JSONPlaceholder API からデータを取得して表示します
      </p>

      {/* エラー表示 */}
      {error && (
        <div style={{
          backgroundColor: '#f8d7da',
          color: '#721c24',
          padding: '1rem',
          borderRadius: '8px',
          marginBottom: '1rem'
        }}>
          エラー: {error}
        </div>
      )}

      <div style={{ display: 'grid', gridTemplateColumns: '1fr 2fr', gap: '2rem' }}>
        {/* ユーザー一覧 */}
        <div>
          <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', marginBottom: '1rem' }}>
            <h2 style={{ margin: 0 }}>ユーザー一覧</h2>
            <button
              onClick={fetchUsers}
              disabled={loading}
              style={{
                padding: '0.5rem 1rem',
                backgroundColor: '#667eea',
                color: 'white',
                border: 'none',
                borderRadius: '4px',
                cursor: loading ? 'not-allowed' : 'pointer',
                opacity: loading ? 0.6 : 1
              }}
            >
              {loading ? '読み込み中...' : '更新'}
            </button>
          </div>

          {loading && users.length === 0 ? (
            <div style={{ textAlign: 'center', padding: '2rem', color: '#666' }}>
              <div style={{ fontSize: '2rem', marginBottom: '0.5rem' }}>⏳</div>
              <div>読み込み中...</div>
            </div>
          ) : (
            <ul style={{ listStyle: 'none', padding: 0, margin: 0 }}>
              {users.map(user => (
                <li
                  key={user.id}
                  onClick={() => fetchUserPosts(user.id)}
                  style={{
                    padding: '1rem',
                    marginBottom: '0.5rem',
                    backgroundColor: selectedUser === user.id ? '#667eea' : '#f8f9fa',
                    color: selectedUser === user.id ? 'white' : '#333',
                    borderRadius: '8px',
                    cursor: 'pointer',
                    transition: 'all 0.3s'
                  }}
                >
                  <div style={{ fontWeight: 'bold' }}>{user.name}</div>
                  <div style={{
                    fontSize: '0.875rem',
                    opacity: 0.8,
                    marginTop: '0.25rem'
                  }}>
                    {user.email}
                  </div>
                </li>
              ))}
            </ul>
          )}
        </div>

        {/* 投稿一覧 */}
        <div>
          <h2 style={{ marginBottom: '1rem' }}>
            {selectedUser ? `ユーザー ${selectedUser} の投稿` : '投稿を表示'}
          </h2>

          {selectedUser === null ? (
            <div style={{
              textAlign: 'center',
              padding: '3rem',
              backgroundColor: '#f8f9fa',
              borderRadius: '8px',
              color: '#666'
            }}>
              <div style={{ fontSize: '3rem', marginBottom: '1rem' }}>👈</div>
              <div>ユーザーを選択して投稿を表示してください</div>
            </div>
          ) : loading ? (
            <div style={{ textAlign: 'center', padding: '2rem', color: '#666' }}>
              <div style={{ fontSize: '2rem', marginBottom: '0.5rem' }}>⏳</div>
              <div>読み込み中...</div>
            </div>
          ) : posts.length === 0 ? (
            <div style={{
              textAlign: 'center',
              padding: '2rem',
              backgroundColor: '#f8f9fa',
              borderRadius: '8px',
              color: '#666'
            }}>
              投稿がありません
            </div>
          ) : (
            <div style={{ display: 'grid', gap: '1rem' }}>
              {posts.map(post => (
                <div
                  key={post.id}
                  style={{
                    border: '1px solid #ddd',
                    padding: '1.5rem',
                    borderRadius: '8px',
                    backgroundColor: 'white'
                  }}
                >
                  <h3 style={{ margin: '0 0 0.5rem 0', color: '#333' }}>
                    {post.title}
                  </h3>
                  <p style={{ margin: 0, color: '#666', lineHeight: '1.6' }}>
                    {post.body}
                  </p>
                  <div style={{
                    marginTop: '0.5rem',
                    fontSize: '0.875rem',
                    color: '#999'
                  }}>
                    投稿ID: {post.id}
                  </div>
                </div>
              ))}
            </div>
          )}
        </div>
      </div>

      <div style={{
        backgroundColor: '#fff3cd',
        padding: '1rem',
        borderRadius: '8px',
        marginTop: '2rem'
      }}>
        <h3>💡 このレッスンで学んだこと</h3>
        <ul>
          <li>fetch API を使った非同期データ取得</li>
          <li>async/await でのエラーハンドリング</li>
          <li>ローディング状態の管理</li>
          <li>動的なデータ取得（ユーザー選択に応じて投稿を取得）</li>
          <li>外部API（JSONPlaceholder）の利用</li>
        </ul>
      </div>
    </div>
  );
}

export default Lesson05;
