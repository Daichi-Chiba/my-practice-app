# Lesson 04: 状態管理

## 🎯 学習目標

- リフトアップの概念を理解する
- useReducer で複雑な状態を管理する
- Context API でグローバル状態を実装する
- 状態管理のベストプラクティスを学ぶ

## 📖 概要

アプリケーションが大きくなると、状態管理が複雑になります。このレッスンでは、効果的な状態管理のパターンを学びます。

## ⬆️ 状態のリフトアップ

### 問題: 兄弟コンポーネント間でデータ共有

```jsx
// ❌ 良くない例：兄弟間で直接通信できない
function ComponentA() {
  const [data, setData] = useState('');
  // ComponentB にデータを渡せない
}

function ComponentB() {
  // ComponentA のデータを受け取れない
}
```

### 解決: 親コンポーネントに状態を持たせる

```jsx
import { useState } from 'react';

// 親コンポーネント
function Parent() {
  const [sharedData, setSharedData] = useState('');
  
  return (
    <div>
      <ComponentA data={sharedData} setData={setSharedData} />
      <ComponentB data={sharedData} />
    </div>
  );
}

// 子コンポーネントA（データを更新）
function ComponentA({ data, setData }) {
  return (
    <input 
      value={data}
      onChange={(e) => setData(e.target.value)}
      placeholder="入力してください"
    />
  );
}

// 子コンポーネントB（データを表示）
function ComponentB({ data }) {
  return <p>入力された内容: {data}</p>;
}
```

## 🔄 useReducer

複雑な状態ロジックには useReducer を使用します。

### 基本的な使い方

```jsx
import { useReducer } from 'react';

// Reducer関数
function counterReducer(state, action) {
  switch (action.type) {
    case 'INCREMENT':
      return { count: state.count + 1 };
    case 'DECREMENT':
      return { count: state.count - 1 };
    case 'RESET':
      return { count: 0 };
    default:
      return state;
  }
}

function Counter() {
  const [state, dispatch] = useReducer(counterReducer, { count: 0 });
  
  return (
    <div>
      <p>カウント: {state.count}</p>
      <button onClick={() => dispatch({ type: 'INCREMENT' })}>+1</button>
      <button onClick={() => dispatch({ type: 'DECREMENT' })}>-1</button>
      <button onClick={() => dispatch({ type: 'RESET' })}>リセット</button>
    </div>
  );
}
```

### TODOアプリの例

```jsx
import { useReducer, useState } from 'react';

// Reducer
function todosReducer(state, action) {
  switch (action.type) {
    case 'ADD':
      return [...state, { 
        id: Date.now(), 
        text: action.payload, 
        done: false 
      }];
    case 'TOGGLE':
      return state.map(todo =>
        todo.id === action.payload 
          ? { ...todo, done: !todo.done }
          : todo
      );
    case 'DELETE':
      return state.filter(todo => todo.id !== action.payload);
    default:
      return state;
  }
}

function TodoApp() {
  const [todos, dispatch] = useReducer(todosReducer, []);
  const [input, setInput] = useState('');
  
  const handleAdd = () => {
    if (input.trim()) {
      dispatch({ type: 'ADD', payload: input });
      setInput('');
    }
  };
  
  return (
    <div>
      <h1>TODO リスト</h1>
      <input 
        value={input}
        onChange={(e) => setInput(e.target.value)}
        onKeyPress={(e) => e.key === 'Enter' && handleAdd()}
      />
      <button onClick={handleAdd}>追加</button>
      
      <ul>
        {todos.map(todo => (
          <li key={todo.id}>
            <input 
              type="checkbox"
              checked={todo.done}
              onChange={() => dispatch({ type: 'TOGGLE', payload: todo.id })}
            />
            <span style={{ textDecoration: todo.done ? 'line-through' : 'none' }}>
              {todo.text}
            </span>
            <button onClick={() => dispatch({ type: 'DELETE', payload: todo.id })}>
              削除
            </button>
          </li>
        ))}
      </ul>
    </div>
  );
}

export default TodoApp;
```

## 🌍 Context + useReducer

グローバルな状態管理の実装例：

```jsx
import { createContext, useContext, useReducer } from 'react';

// Context作成
const CartContext = createContext();

// Reducer
function cartReducer(state, action) {
  switch (action.type) {
    case 'ADD_ITEM':
      const existing = state.items.find(item => item.id === action.payload.id);
      if (existing) {
        return {
          ...state,
          items: state.items.map(item =>
            item.id === action.payload.id
              ? { ...item, quantity: item.quantity + 1 }
              : item
          )
        };
      }
      return {
        ...state,
        items: [...state.items, { ...action.payload, quantity: 1 }]
      };
    
    case 'REMOVE_ITEM':
      return {
        ...state,
        items: state.items.filter(item => item.id !== action.payload)
      };
    
    case 'CLEAR':
      return { items: [] };
    
    default:
      return state;
  }
}

// Provider
export function CartProvider({ children }) {
  const [cart, dispatch] = useReducer(cartReducer, { items: [] });
  
  const addItem = (item) => dispatch({ type: 'ADD_ITEM', payload: item });
  const removeItem = (id) => dispatch({ type: 'REMOVE_ITEM', payload: id });
  const clearCart = () => dispatch({ type: 'CLEAR' });
  
  const total = cart.items.reduce((sum, item) => sum + item.price * item.quantity, 0);
  
  return (
    <CartContext.Provider value={{ cart, addItem, removeItem, clearCart, total }}>
      {children}
    </CartContext.Provider>
  );
}

// カスタムフック
export function useCart() {
  const context = useContext(CartContext);
  if (!context) {
    throw new Error('useCart must be used within CartProvider');
  }
  return context;
}

// 商品コンポーネント
function Product({ product }) {
  const { addItem } = useCart();
  
  return (
    <div style={{ border: '1px solid #ddd', padding: '10px', margin: '10px' }}>
      <h3>{product.name}</h3>
      <p>¥{product.price}</p>
      <button onClick={() => addItem(product)}>カートに追加</button>
    </div>
  );
}

// カートコンポーネント
function Cart() {
  const { cart, removeItem, clearCart, total } = useCart();
  
  return (
    <div style={{ border: '1px solid #ddd', padding: '20px' }}>
      <h2>ショッピングカート</h2>
      {cart.items.length === 0 ? (
        <p>カートは空です</p>
      ) : (
        <>
          <ul>
            {cart.items.map(item => (
              <li key={item.id}>
                {item.name} x {item.quantity} = ¥{item.price * item.quantity}
                <button onClick={() => removeItem(item.id)}>削除</button>
              </li>
            ))}
          </ul>
          <p><strong>合計: ¥{total}</strong></p>
          <button onClick={clearCart}>カートをクリア</button>
        </>
      )}
    </div>
  );
}

// アプリケーション
function App() {
  const products = [
    { id: 1, name: 'ノートPC', price: 100000 },
    { id: 2, name: 'マウス', price: 3000 },
    { id: 3, name: 'キーボード', price: 8000 },
  ];
  
  return (
    <CartProvider>
      <div style={{ padding: '20px' }}>
        <h1>オンラインショップ</h1>
        <div style={{ display: 'flex', gap: '20px' }}>
          <div style={{ flex: 2 }}>
            <h2>商品一覧</h2>
            {products.map(product => (
              <Product key={product.id} product={product} />
            ))}
          </div>
          <div style={{ flex: 1 }}>
            <Cart />
          </div>
        </div>
      </div>
    </CartProvider>
  );
}

export default App;
```

## 📝 演習問題

### 問題1: カウンターアプリ（useReducer）
useReducer を使って、増加・減少・リセット・指定値設定ができるカウンターを作成してください。

### 問題2: フォーム管理
複数の入力フィールドを持つフォームを useReducer で管理してください。

### 問題3: ユーザー管理
Context + useReducer を使って、ユーザーの追加・削除・編集ができるアプリを作成してください。

## 🎓 まとめ

- 状態のリフトアップで兄弟コンポーネント間でデータを共有できます
- useReducer は複雑な状態ロジックに適しています
- Context API でグローバルな状態を実装できます
- useReducer + Context でアプリ全体の状態を管理できます

次のレッスンでは、API連携について学びます。

## 📚 参考リンク

- [React useReducer](https://react.dev/reference/react/useReducer)
- [React Context](https://react.dev/learn/passing-data-deeply-with-context)
