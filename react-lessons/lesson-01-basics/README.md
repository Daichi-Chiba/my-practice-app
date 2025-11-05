# Lesson 01: React 基礎

## 🎯 学習目標

- Reactの基本概念を理解する
- JSXの書き方を学ぶ
- 初めてのReactコンポーネントを作成する
- Create React Appでプロジェクトをセットアップする

## 📖 概要

Reactは、ユーザーインターフェースを構築するためのJavaScriptライブラリです。Facebookによって開発され、コンポーネントベースのアプローチで再利用可能なUIを効率的に構築できます。

## 🚀 プロジェクトのセットアップ

### Create React Appを使用

```bash
# このレッスンフォルダに移動
cd lesson-01-basics

# Create React Appでプロジェクト作成
npx create-react-app .

# 開発サーバー起動
npm start
```

ブラウザで http://localhost:3000 が自動的に開きます。

## 💻 JSXの基本

JSX (JavaScript XML) は、JavaScriptの中にHTMLライクな構文を書ける拡張です。

### 基本的なJSX

```jsx
// src/App.js
function App() {
  return (
    <div className="App">
      <h1>Hello, React!</h1>
      <p>これはJSXです</p>
    </div>
  );
}

export default App;
```

### JavaScriptの式を埋め込む

```jsx
function App() {
  const name = '太郎';
  const age = 25;
  
  return (
    <div>
      <h1>こんにちは、{name}さん</h1>
      <p>年齢: {age}歳</p>
      <p>来年は{age + 1}歳です</p>
    </div>
  );
}
```

### 属性の指定

```jsx
function App() {
  const imageUrl = 'https://via.placeholder.com/150';
  const altText = 'プレースホルダー画像';
  
  return (
    <div>
      {/* HTMLのclassはclassNameになる */}
      <div className="container">
        
        {/* 属性に変数を使用 */}
        <img src={imageUrl} alt={altText} />
        
        {/* インラインスタイル */}
        <p style={{ color: 'blue', fontSize: '20px' }}>
          青いテキスト
        </p>
      </div>
    </div>
  );
}
```

### JSXのルール

1. **必ず単一のルート要素を返す**
```jsx
// ❌ ダメな例
function App() {
  return (
    <h1>タイトル</h1>
    <p>段落</p>
  );
}

// ✅ 良い例1: divで囲む
function App() {
  return (
    <div>
      <h1>タイトル</h1>
      <p>段落</p>
    </div>
  );
}

// ✅ 良い例2: Fragmentを使用
function App() {
  return (
    <>
      <h1>タイトル</h1>
      <p>段落</p>
    </>
  );
}
```

2. **タグは必ず閉じる**
```jsx
// ❌ ダメ
<img src="image.jpg">

// ✅ 良い
<img src="image.jpg" />
```

3. **classNameを使用**
```jsx
// ❌ ダメ
<div class="container">

// ✅ 良い
<div className="container">
```

## 🎨 初めてのコンポーネント

### 関数コンポーネント

```jsx
// src/components/Welcome.js
function Welcome() {
  return (
    <div>
      <h2>ようこそ！</h2>
      <p>Reactの世界へ</p>
    </div>
  );
}

export default Welcome;
```

```jsx
// src/App.js
import Welcome from './components/Welcome';

function App() {
  return (
    <div className="App">
      <h1>My React App</h1>
      <Welcome />
    </div>
  );
}

export default App;
```

### 複数のコンポーネント

```jsx
// src/components/Header.js
function Header() {
  return (
    <header style={{ background: '#282c34', color: 'white', padding: '20px' }}>
      <h1>My Website</h1>
      <nav>
        <a href="/" style={{ color: 'white', margin: '0 10px' }}>ホーム</a>
        <a href="/about" style={{ color: 'white', margin: '0 10px' }}>About</a>
      </nav>
    </header>
  );
}

export default Header;
```

```jsx
// src/components/Footer.js
function Footer() {
  return (
    <footer style={{ background: '#f0f0f0', padding: '20px', marginTop: '40px' }}>
      <p>&copy; 2024 My Website</p>
    </footer>
  );
}

export default Footer;
```

```jsx
// src/App.js
import Header from './components/Header';
import Footer from './components/Footer';
import Welcome from './components/Welcome';

function App() {
  return (
    <div className="App">
      <Header />
      <main style={{ padding: '20px', minHeight: '60vh' }}>
        <Welcome />
      </main>
      <Footer />
    </div>
  );
}

export default App;
```

## 📝 演習問題

### 問題1: 自己紹介コンポーネント

自己紹介を表示する `Profile` コンポーネントを作成してください：
- 名前
- 年齢
- 趣味

### 問題2: カードコンポーネント

商品カードを表示する `ProductCard` コンポーネントを作成してください：
- 商品名
- 価格
- 画像（プレースホルダーでOK）

### 問題3: リスト表示

果物のリストを表示するコンポーネントを作成してください。

## ✅ 解答例

### 問題1の解答

```jsx
// src/components/Profile.js
function Profile() {
  const name = '田中太郎';
  const age = 25;
  const hobbies = ['読書', 'プログラミング', '音楽鑑賞'];
  
  return (
    <div style={{ border: '1px solid #ddd', padding: '20px', borderRadius: '8px' }}>
      <h2>自己紹介</h2>
      <p><strong>名前:</strong> {name}</p>
      <p><strong>年齢:</strong> {age}歳</p>
      <p><strong>趣味:</strong></p>
      <ul>
        {hobbies.map((hobby, index) => (
          <li key={index}>{hobby}</li>
        ))}
      </ul>
    </div>
  );
}

export default Profile;
```

### 問題2の解答

```jsx
// src/components/ProductCard.js
function ProductCard() {
  const product = {
    name: 'ノートPC',
    price: 100000,
    image: 'https://via.placeholder.com/200'
  };
  
  return (
    <div style={{ 
      border: '1px solid #ddd', 
      padding: '15px', 
      borderRadius: '8px',
      width: '250px'
    }}>
      <img 
        src={product.image} 
        alt={product.name}
        style={{ width: '100%', borderRadius: '4px' }}
      />
      <h3>{product.name}</h3>
      <p style={{ fontSize: '24px', color: '#e74c3c' }}>
        ¥{product.price.toLocaleString()}
      </p>
      <button style={{ 
        padding: '10px 20px', 
        background: '#3498db', 
        color: 'white',
        border: 'none',
        borderRadius: '4px',
        cursor: 'pointer'
      }}>
        カートに追加
      </button>
    </div>
  );
}

export default ProductCard;
```

### 問題3の解答

```jsx
// src/components/FruitList.js
function FruitList() {
  const fruits = ['りんご', 'バナナ', 'オレンジ', 'ぶどう', 'いちご'];
  
  return (
    <div>
      <h2>果物リスト</h2>
      <ul>
        {fruits.map((fruit, index) => (
          <li key={index}>{fruit}</li>
        ))}
      </ul>
    </div>
  );
}

export default FruitList;
```

## 🎓 まとめ

- Reactはコンポーネントベースのライブラリです
- JSXでHTMLライクな構文をJavaScriptに書けます
- コンポーネントは再利用可能なUI部品です
- `{}` を使ってJavaScriptの式を埋め込めます

次のレッスンでは、Propsを使ってコンポーネントにデータを渡す方法を学びます。

## 📚 参考リンク

- [React公式ドキュメント](https://react.dev)
- [Create React App](https://create-react-app.dev/)
