// Lesson 03: React フック (useState, useEffect)

import { useState, useEffect } from 'react';

function Lesson03() {
  // useState の例
  const [count, setCount] = useState(0);
  const [name, setName] = useState('');
  const [todos, setTodos] = useState([]);
  const [newTodo, setNewTodo] = useState('');

  // useEffect の例 - タイトル更新
  useEffect(() => {
    document.title = `カウント: ${count}`;
  }, [count]);

  // useEffect の例 - マウント時のみ実行
  useEffect(() => {
    console.log('コンポーネントがマウントされました');
  }, []);

  const addTodo = () => {
    if (newTodo.trim()) {
      setTodos([...todos, { id: Date.now(), text: newTodo, done: false }]);
      setNewTodo('');
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
    <div style={{ padding: '2rem' }}>
      <h1 style={{ color: '#667eea', marginBottom: '1rem' }}>Lesson 03: React フック</h1>

      <section style={{ marginBottom: '2rem', padding: '1rem', border: '1px solid #ddd', borderRadius: '8px' }}>
        <h2>useState - カウンター</h2>
        <p style={{ fontSize: '2rem', margin: '1rem 0' }}>カウント: {count}</p>
        <div style={{ display: 'flex', gap: '0.5rem' }}>
          <button onClick={() => setCount(count + 1)} style={buttonStyle}>+1</button>
          <button onClick={() => setCount(count - 1)} style={buttonStyle}>-1</button>
          <button onClick={() => setCount(0)} style={{ ...buttonStyle, backgroundColor: '#6c757d' }}>リセット</button>
        </div>
      </section>

      <section style={{ marginBottom: '2rem', padding: '1rem', border: '1px solid #ddd', borderRadius: '8px' }}>
        <h2>useState - 入力フォーム</h2>
        <input
          type="text"
          value={name}
          onChange={(e) => setName(e.target.value)}
          placeholder="名前を入力"
          style={{ padding: '0.5rem', fontSize: '1rem', width: '300px', marginRight: '1rem' }}
        />
        <p>入力された名前: <strong>{name}</strong></p>
      </section>

      <section style={{ marginBottom: '2rem', padding: '1rem', border: '1px solid #ddd', borderRadius: '8px' }}>
        <h2>useState + useEffect - TODOリスト</h2>
        <div style={{ display: 'flex', gap: '0.5rem', marginBottom: '1rem' }}>
          <input
            type="text"
            value={newTodo}
            onChange={(e) => setNewTodo(e.target.value)}
            onKeyPress={(e) => e.key === 'Enter' && addTodo()}
            placeholder="新しいTODO"
            style={{ padding: '0.5rem', fontSize: '1rem', flex: 1 }}
          />
          <button onClick={addTodo} style={buttonStyle}>追加</button>
        </div>

        <ul style={{ listStyle: 'none', padding: 0 }}>
          {todos.map(todo => (
            <li key={todo.id} style={{
              padding: '0.75rem',
              marginBottom: '0.5rem',
              backgroundColor: '#f8f9fa',
              borderRadius: '4px',
              display: 'flex',
              alignItems: 'center',
              gap: '1rem'
            }}>
              <input
                type="checkbox"
                checked={todo.done}
                onChange={() => toggleTodo(todo.id)}
              />
              <span style={{
                flex: 1,
                textDecoration: todo.done ? 'line-through' : 'none',
                color: todo.done ? '#6c757d' : '#333'
              }}>
                {todo.text}
              </span>
              <button
                onClick={() => deleteTodo(todo.id)}
                style={{ ...buttonStyle, backgroundColor: '#dc3545' }}
              >
                削除
              </button>
            </li>
          ))}
        </ul>
      </section>

      <div style={{
        backgroundColor: '#fff3cd',
        padding: '1rem',
        borderRadius: '8px'
      }}>
        <h3>💡 このレッスンで学んだこと</h3>
        <ul>
          <li>useState で状態を管理</li>
          <li>useEffect で副作用を処理</li>
          <li>配列の状態更新（追加、削除、更新）</li>
          <li>イベントハンドラの使い方</li>
        </ul>
      </div>
    </div>
  );
}

const buttonStyle = {
  padding: '0.5rem 1rem',
  backgroundColor: '#667eea',
  color: 'white',
  border: 'none',
  borderRadius: '4px',
  cursor: 'pointer'
};

export default Lesson03;
