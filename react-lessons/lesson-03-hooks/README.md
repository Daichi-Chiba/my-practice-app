# Lesson 03: React フック

## 🎯 学習目標

- useState で状態管理を学ぶ
- useEffect で副作用を処理する
- useContext でグローバル状態を扱う
- カスタムフックを作成する

## 📖 概要

React フックは、関数コンポーネントで状態や副作用などのReactの機能を使えるようにする仕組みです。

## 💻 useState - 状態管理

### 基本的な使い方

```jsx
import { useState } from 'react';

function Counter() {
  const [count, setCount] = useState(0);
  
  return (
    <div>
      <p>カウント: {count}</p>
      <button onClick={() => setCount(count + 1)}>+1</button>
      <button onClick={() => setCount(count - 1)}>-1</button>
      <button onClick={() => setCount(0)}>リセット</button>
    </div>
  );
}

export default Counter;
```

### 複数の状態

```jsx
import { useState } from 'react';

function Form() {
  const [name, setName] = useState('');
  const [email, setEmail] = useState('');
  const [age, setAge] = useState(0);
  
  const handleSubmit = (e) => {
    e.preventDefault();
    console.log({ name, email, age });
  };
  
  return (
    <form onSubmit={handleSubmit}>
      <input 
        type="text" 
        value={name}
        onChange={(e) => setName(e.target.value)}
        placeholder="名前"
      />
      <input 
        type="email" 
        value={email}
        onChange={(e) => setEmail(e.target.value)}
        placeholder="メール"
      />
      <input 
        type="number" 
        value={age}
        onChange={(e) => setAge(e.target.value)}
        placeholder="年齢"
      />
      <button type="submit">送信</button>
    </form>
  );
}
```

### オブジェクトの状態

```jsx
import { useState } from 'react';

function UserForm() {
  const [user, setUser] = useState({
    name: '',
    email: '',
    age: 0
  });
  
  const handleChange = (e) => {
    setUser({
      ...user,
      [e.target.name]: e.target.value
    });
  };
  
  return (
    <div>
      <input name="name" value={user.name} onChange={handleChange} />
      <input name="email" value={user.email} onChange={handleChange} />
      <input name="age" type="number" value={user.age} onChange={handleChange} />
      <pre>{JSON.stringify(user, null, 2)}</pre>
    </div>
  );
}
```

### 配列の状態

```jsx
import { useState } from 'react';

function TodoList() {
  const [todos, setTodos] = useState([]);
  const [input, setInput] = useState('');
  
  const addTodo = () => {
    if (input.trim()) {
      setTodos([...todos, { id: Date.now(), text: input, done: false }]);
      setInput('');
    }
  };
  
  const toggleTodo = (id) => {
    setTodos(todos.map(todo => 
      todo.id === id ? { ...todo, done: !todo.done } : todo
    ));
  };
  
  const deleteTodo = (id) => {
    setTodos(todos.filter(todo => todo.id !== id));
  };
  
  return (
    <div>
      <input 
        value={input}
        onChange={(e) => setInput(e.target.value)}
        onKeyPress={(e) => e.key === 'Enter' && addTodo()}
      />
      <button onClick={addTodo}>追加</button>
      
      <ul>
        {todos.map(todo => (
          <li key={todo.id}>
            <input 
              type="checkbox"
              checked={todo.done}
              onChange={() => toggleTodo(todo.id)}
            />
            <span style={{ textDecoration: todo.done ? 'line-through' : 'none' }}>
              {todo.text}
            </span>
            <button onClick={() => deleteTodo(todo.id)}>削除</button>
          </li>
        ))}
      </ul>
    </div>
  );
}

export default TodoList;
```

## ⚡ useEffect - 副作用

### 基本的な使い方

```jsx
import { useState, useEffect } from 'react';

function Timer() {
  const [seconds, setSeconds] = useState(0);
  
  useEffect(() => {
    const interval = setInterval(() => {
      setSeconds(s => s + 1);
    }, 1000);
    
    // クリーンアップ関数
    return () => clearInterval(interval);
  }, []); // 空配列 = マウント時のみ実行
  
  return <div>経過時間: {seconds}秒</div>;
}
```

### 依存配列

```jsx
import { useState, useEffect } from 'react';

function SearchComponent() {
  const [query, setQuery] = useState('');
  const [results, setResults] = useState([]);
  
  useEffect(() => {
    if (query) {
      console.log(`"${query}" で検索中...`);
      // API呼び出しなど
    }
  }, [query]); // queryが変わったときに実行
  
  return (
    <div>
      <input 
        value={query}
        onChange={(e) => setQuery(e.target.value)}
        placeholder="検索..."
      />
    </div>
  );
}
```

### データ取得

```jsx
import { useState, useEffect } from 'react';

function UserList() {
  const [users, setUsers] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);
  
  useEffect(() => {
    fetch('https://jsonplaceholder.typicode.com/users')
      .then(response => response.json())
      .then(data => {
        setUsers(data);
        setLoading(false);
      })
      .catch(err => {
        setError(err.message);
        setLoading(false);
      });
  }, []);
  
  if (loading) return <div>読み込み中...</div>;
  if (error) return <div>エラー: {error}</div>;
  
  return (
    <ul>
      {users.map(user => (
        <li key={user.id}>{user.name}</li>
      ))}
    </ul>
  );
}
```

## 🌍 useContext - グローバル状態

```jsx
import { createContext, useContext, useState } from 'react';

// Context作成
const ThemeContext = createContext();

// Provider コンポーネント
function ThemeProvider({ children }) {
  const [theme, setTheme] = useState('light');
  
  const toggleTheme = () => {
    setTheme(theme === 'light' ? 'dark' : 'light');
  };
  
  return (
    <ThemeContext.Provider value={{ theme, toggleTheme }}>
      {children}
    </ThemeContext.Provider>
  );
}

// Context を使用
function ThemedButton() {
  const { theme, toggleTheme } = useContext(ThemeContext);
  
  return (
    <button
      onClick={toggleTheme}
      style={{
        background: theme === 'light' ? '#fff' : '#333',
        color: theme === 'light' ? '#333' : '#fff'
      }}
    >
      {theme === 'light' ? '🌙 ダーク' : '☀️ ライト'}
    </button>
  );
}

// App
function App() {
  return (
    <ThemeProvider>
      <div>
        <h1>テーマ切り替え</h1>
        <ThemedButton />
      </div>
    </ThemeProvider>
  );
}
```

## 🛠️ カスタムフック

```jsx
import { useState, useEffect } from 'react';

// カスタムフック: ローカルストレージ
function useLocalStorage(key, initialValue) {
  const [value, setValue] = useState(() => {
    const saved = localStorage.getItem(key);
    return saved ? JSON.parse(saved) : initialValue;
  });
  
  useEffect(() => {
    localStorage.setItem(key, JSON.stringify(value));
  }, [key, value]);
  
  return [value, setValue];
}

// 使用例
function Counter() {
  const [count, setCount] = useLocalStorage('count', 0);
  
  return (
    <div>
      <p>カウント: {count}</p>
      <button onClick={() => setCount(count + 1)}>+1</button>
    </div>
  );
}
```

```jsx
// カスタムフック: データ取得
function useFetch(url) {
  const [data, setData] = useState(null);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);
  
  useEffect(() => {
    fetch(url)
      .then(res => res.json())
      .then(data => {
        setData(data);
        setLoading(false);
      })
      .catch(err => {
        setError(err);
        setLoading(false);
      });
  }, [url]);
  
  return { data, loading, error };
}

// 使用例
function Users() {
  const { data, loading, error } = useFetch('https://jsonplaceholder.typicode.com/users');
  
  if (loading) return <div>読み込み中...</div>;
  if (error) return <div>エラー: {error.message}</div>;
  
  return (
    <ul>
      {data.map(user => (
        <li key={user.id}>{user.name}</li>
      ))}
    </ul>
  );
}
```

## 📝 演習問題

### 問題1: カウンターアプリ
useState を使って、増加・減少・リセットボタンのあるカウンターを作成してください。

### 問題2: フォーム
名前、メール、メッセージを入力できるお問い合わせフォームを作成し、送信時にデータをコンソールに出力してください。

### 問題3: タイマー
useEffect を使って1秒ごとにカウントアップするタイマーを作成してください。開始・停止ボタンも実装してください。

## 🎓 まとめ

- useState で状態を管理できます
- useEffect で副作用（API呼び出し、タイマーなど）を処理できます
- useContext でグローバルな状態を共有できます
- カスタムフックでロジックを再利用できます

次のレッスンでは、状態管理のパターンとuseReducerを学びます。

## 📚 参考リンク

- [React Hooks](https://react.dev/reference/react)
