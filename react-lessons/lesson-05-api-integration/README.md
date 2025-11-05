# Lesson 05: API連携

## 🎯 学習目標

- fetch API でデータを取得する
- axios ライブラリを使う
- ローディング状態とエラーハンドリングを実装する
- CRUD操作を行う

## 📖 概要

実際のアプリケーションでは、外部APIからデータを取得したり、サーバーにデータを送信したりする必要があります。このレッスンでは、API連携の方法を学びます。

## 🌐 fetch API

### 基本的なGETリクエスト

```jsx
import { useState, useEffect } from 'react';

function UserList() {
  const [users, setUsers] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);
  
  useEffect(() => {
    fetch('https://jsonplaceholder.typicode.com/users')
      .then(response => {
        if (!response.ok) {
          throw new Error('データの取得に失敗しました');
        }
        return response.json();
      })
      .then(data => {
        setUsers(data);
        setLoading(false);
      })
      .catch(error => {
        setError(error.message);
        setLoading(false);
      });
  }, []);
  
  if (loading) return <div>読み込み中...</div>;
  if (error) return <div>エラー: {error}</div>;
  
  return (
    <div>
      <h1>ユーザー一覧</h1>
      <ul>
        {users.map(user => (
          <li key={user.id}>
            {user.name} - {user.email}
          </li>
        ))}
      </ul>
    </div>
  );
}

export default UserList;
```

### async/await を使用

```jsx
import { useState, useEffect } from 'react';

function Posts() {
  const [posts, setPosts] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);
  
  useEffect(() => {
    const fetchPosts = async () => {
      try {
        const response = await fetch('https://jsonplaceholder.typicode.com/posts');
        if (!response.ok) {
          throw new Error('データの取得に失敗しました');
        }
        const data = await response.json();
        setPosts(data);
      } catch (err) {
        setError(err.message);
      } finally {
        setLoading(false);
      }
    };
    
    fetchPosts();
  }, []);
  
  if (loading) return <div>読み込み中...</div>;
  if (error) return <div>エラー: {error}</div>;
  
  return (
    <div>
      <h1>投稿一覧</h1>
      {posts.slice(0, 10).map(post => (
        <div key={post.id} style={{ border: '1px solid #ddd', padding: '10px', margin: '10px 0' }}>
          <h3>{post.title}</h3>
          <p>{post.body}</p>
        </div>
      ))}
    </div>
  );
}

export default Posts;
```

## 📡 axios ライブラリ

axiosはより強力で使いやすいHTTPクライアントです。

### インストール

```bash
npm install axios
```

### 基本的な使い方

```jsx
import { useState, useEffect } from 'react';
import axios from 'axios';

function Users() {
  const [users, setUsers] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);
  
  useEffect(() => {
    axios.get('https://jsonplaceholder.typicode.com/users')
      .then(response => {
        setUsers(response.data);
        setLoading(false);
      })
      .catch(error => {
        setError(error.message);
        setLoading(false);
      });
  }, []);
  
  if (loading) return <div>読み込み中...</div>;
  if (error) return <div>エラー: {error}</div>;
  
  return (
    <div>
      <h1>ユーザー一覧</h1>
      <ul>
        {users.map(user => (
          <li key={user.id}>{user.name}</li>
        ))}
      </ul>
    </div>
  );
}
```

### async/await との組み合わせ

```jsx
import { useState, useEffect } from 'react';
import axios from 'axios';

function Comments() {
  const [comments, setComments] = useState([]);
  const [loading, setLoading] = useState(true);
  
  useEffect(() => {
    const fetchComments = async () => {
      try {
        const response = await axios.get('https://jsonplaceholder.typicode.com/comments');
        setComments(response.data.slice(0, 20));
      } catch (error) {
        console.error('エラー:', error);
      } finally {
        setLoading(false);
      }
    };
    
    fetchComments();
  }, []);
  
  if (loading) return <div>読み込み中...</div>;
  
  return (
    <div>
      {comments.map(comment => (
        <div key={comment.id}>
          <strong>{comment.name}</strong>
          <p>{comment.body}</p>
        </div>
      ))}
    </div>
  );
}
```

## 🔄 CRUD操作

### POSTリクエスト（作成）

```jsx
import { useState } from 'react';
import axios from 'axios';

function CreatePost() {
  const [title, setTitle] = useState('');
  const [body, setBody] = useState('');
  const [loading, setLoading] = useState(false);
  const [message, setMessage] = useState('');
  
  const handleSubmit = async (e) => {
    e.preventDefault();
    setLoading(true);
    
    try {
      const response = await axios.post('https://jsonplaceholder.typicode.com/posts', {
        title,
        body,
        userId: 1
      });
      
      console.log('作成されたデータ:', response.data);
      setMessage('投稿が作成されました！');
      setTitle('');
      setBody('');
    } catch (error) {
      setMessage('エラーが発生しました: ' + error.message);
    } finally {
      setLoading(false);
    }
  };
  
  return (
    <div>
      <h2>新規投稿</h2>
      <form onSubmit={handleSubmit}>
        <div>
          <input 
            type="text"
            value={title}
            onChange={(e) => setTitle(e.target.value)}
            placeholder="タイトル"
            required
          />
        </div>
        <div>
          <textarea 
            value={body}
            onChange={(e) => setBody(e.target.value)}
            placeholder="本文"
            required
          />
        </div>
        <button type="submit" disabled={loading}>
          {loading ? '送信中...' : '投稿'}
        </button>
      </form>
      {message && <p>{message}</p>}
    </div>
  );
}
```

### PUTリクエスト（更新）

```jsx
import { useState } from 'react';
import axios from 'axios';

function UpdatePost({ postId }) {
  const [title, setTitle] = useState('');
  const [loading, setLoading] = useState(false);
  
  const handleUpdate = async () => {
    setLoading(true);
    
    try {
      const response = await axios.put(
        `https://jsonplaceholder.typicode.com/posts/${postId}`,
        {
          id: postId,
          title,
          body: 'Updated body',
          userId: 1
        }
      );
      
      console.log('更新されたデータ:', response.data);
      alert('更新されました！');
    } catch (error) {
      console.error('エラー:', error);
    } finally {
      setLoading(false);
    }
  };
  
  return (
    <div>
      <input 
        value={title}
        onChange={(e) => setTitle(e.target.value)}
        placeholder="新しいタイトル"
      />
      <button onClick={handleUpdate} disabled={loading}>
        {loading ? '更新中...' : '更新'}
      </button>
    </div>
  );
}
```

### DELETEリクエスト（削除）

```jsx
import axios from 'axios';

function DeletePost({ postId, onDelete }) {
  const handleDelete = async () => {
    if (!window.confirm('本当に削除しますか？')) return;
    
    try {
      await axios.delete(`https://jsonplaceholder.typicode.com/posts/${postId}`);
      alert('削除されました！');
      onDelete(postId);
    } catch (error) {
      console.error('エラー:', error);
    }
  };
  
  return (
    <button onClick={handleDelete} style={{ color: 'red' }}>
      削除
    </button>
  );
}
```

## 🔧 カスタムフック

再利用可能なAPI呼び出しフック：

```jsx
import { useState, useEffect } from 'react';
import axios from 'axios';

function useFetch(url) {
  const [data, setData] = useState(null);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);
  
  useEffect(() => {
    const fetchData = async () => {
      try {
        const response = await axios.get(url);
        setData(response.data);
      } catch (err) {
        setError(err);
      } finally {
        setLoading(false);
      }
    };
    
    fetchData();
  }, [url]);
  
  return { data, loading, error };
}

// 使用例
function App() {
  const { data: users, loading, error } = useFetch('https://jsonplaceholder.typicode.com/users');
  
  if (loading) return <div>読み込み中...</div>;
  if (error) return <div>エラー: {error.message}</div>;
  
  return (
    <ul>
      {users.map(user => (
        <li key={user.id}>{user.name}</li>
      ))}
    </ul>
  );
}
```

## 💻 実践例：完全なCRUDアプリ

```jsx
import { useState, useEffect } from 'react';
import axios from 'axios';

function TodoApp() {
  const [todos, setTodos] = useState([]);
  const [newTodo, setNewTodo] = useState('');
  const [loading, setLoading] = useState(true);
  
  // 取得
  useEffect(() => {
    axios.get('https://jsonplaceholder.typicode.com/todos?_limit=5')
      .then(response => {
        setTodos(response.data);
        setLoading(false);
      });
  }, []);
  
  // 作成
  const addTodo = async () => {
    if (!newTodo.trim()) return;
    
    const response = await axios.post('https://jsonplaceholder.typicode.com/todos', {
      title: newTodo,
      completed: false,
      userId: 1
    });
    
    setTodos([...todos, response.data]);
    setNewTodo('');
  };
  
  // 更新
  const toggleTodo = async (id) => {
    const todo = todos.find(t => t.id === id);
    const response = await axios.put(
      `https://jsonplaceholder.typicode.com/todos/${id}`,
      { ...todo, completed: !todo.completed }
    );
    
    setTodos(todos.map(t => t.id === id ? response.data : t));
  };
  
  // 削除
  const deleteTodo = async (id) => {
    await axios.delete(`https://jsonplaceholder.typicode.com/todos/${id}`);
    setTodos(todos.filter(t => t.id !== id));
  };
  
  if (loading) return <div>読み込み中...</div>;
  
  return (
    <div style={{ padding: '20px' }}>
      <h1>TODO アプリ</h1>
      
      <div>
        <input 
          value={newTodo}
          onChange={(e) => setNewTodo(e.target.value)}
          placeholder="新しいTODO"
        />
        <button onClick={addTodo}>追加</button>
      </div>
      
      <ul>
        {todos.map(todo => (
          <li key={todo.id}>
            <input 
              type="checkbox"
              checked={todo.completed}
              onChange={() => toggleTodo(todo.id)}
            />
            <span style={{ textDecoration: todo.completed ? 'line-through' : 'none' }}>
              {todo.title}
            </span>
            <button onClick={() => deleteTodo(todo.id)}>削除</button>
          </li>
        ))}
      </ul>
    </div>
  );
}

export default TodoApp;
```

## 📝 演習問題

### 問題1: ユーザー検索
JSONPlaceholder APIからユーザーを取得し、名前で検索できる機能を実装してください。

### 問題2: 投稿アプリ
JSONPlaceholder APIを使って、投稿の一覧表示・作成・削除ができるアプリを作成してください。

### 問題3: データ更新
特定の投稿を編集できる機能を実装してください。

## 🎓 まとめ

- fetch APIとaxiosでデータを取得できます
- async/awaitで非同期処理を簡潔に書けます
- ローディング状態とエラーハンドリングが重要です
- CRUDすべての操作を実装できます

これでReactの基礎レッスンは完了です！

## 📚 参考リンク

- [Fetch API](https://developer.mozilla.org/ja/docs/Web/API/Fetch_API)
- [axios](https://axios-http.com/)
- [JSONPlaceholder](https://jsonplaceholder.typicode.com/)
