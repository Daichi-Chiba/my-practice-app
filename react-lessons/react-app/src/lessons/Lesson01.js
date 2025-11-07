// Lesson 01: React 基礎とJSX

function Lesson01() {
  const name = '太郎';
  const age = 25;
  const fruits = ['りんご', 'バナナ', 'オレンジ'];

  return (
    <div style={{ padding: '2rem', maxWidth: '1000px', margin: '0 auto' }}>
      <h1 style={{ color: '#667eea', marginBottom: '1rem' }}>Lesson 01: React 基礎とJSX</h1>
      
      <div style={{ 
        background: '#e7f3ff', 
        padding: '1.5rem', 
        borderRadius: '8px', 
        marginBottom: '2rem',
        borderLeft: '4px solid #667eea'
      }}>
        <h3 style={{ margin: '0 0 0.5rem 0', color: '#667eea' }}>📚 このレッスンで学ぶこと</h3>
        <ul style={{ margin: '0.5rem 0 0 1.5rem' }}>
          <li>JSXの基本文法</li>
          <li>変数の表示方法</li>
          <li>配列のmap()によるリスト表示</li>
          <li>条件付きレンダリング</li>
          <li>インラインスタイルの記述</li>
        </ul>
      </div>

      <section style={{ marginBottom: '3rem' }}>
        <h2 style={{ 
          color: '#333', 
          borderBottom: '2px solid #667eea', 
          paddingBottom: '0.5rem', 
          marginBottom: '1rem' 
        }}>
          1. 変数の表示
        </h2>
        
        <div style={{ background: '#f8f9fa', padding: '1.5rem', borderRadius: '8px', marginBottom: '1rem' }}>
          <h4 style={{ margin: '0 0 1rem 0' }}>📝 コード例</h4>
          <pre style={{ 
            background: '#2d2d2d', 
            color: '#f8f8f2', 
            padding: '1.5rem', 
            borderRadius: '8px', 
            overflow: 'auto' 
          }}><code>{`const name = '太郎';
const age = 25;

return (
  <div>
    <p>こんにちは、{name}さん！</p>
    <p>年齢: {age}歳</p>
    <p>来年は{age + 1}歳です</p>
  </div>
);`}</code></pre>
        </div>

        <div style={{ background: '#d1ecf1', padding: '1rem', borderRadius: '8px', marginBottom: '1rem' }}>
          <strong>🔍 実際の表示:</strong>
          <div style={{ marginTop: '0.5rem', padding: '1rem', background: 'white', borderRadius: '4px' }}>
            <p>こんにちは、{name}さん！</p>
            <p>年齢: {age}歳</p>
            <p>来年は{age + 1}歳です</p>
          </div>
        </div>

        <div style={{ background: '#fff3cd', padding: '1rem', borderRadius: '8px' }}>
          <strong>💡 ポイント:</strong>
          <ul style={{ margin: '0.5rem 0 0 1.5rem' }}>
            <li>中括弧 {`{}`} を使って JavaScript の式を埋め込む</li>
            <li>変数、計算式、関数呼び出しなど何でも可能</li>
            <li>自動的に文字列に変換される</li>
          </ul>
        </div>
      </section>

      <section style={{ marginBottom: '2rem' }}>
        <h2>配列のマッピング</h2>
        <ul>
          {fruits.map((fruit, index) => (
            <li key={index}>{fruit}</li>
          ))}
        </ul>
      </section>

      <section style={{ marginBottom: '2rem' }}>
        <h2>インラインスタイル</h2>
        <div style={{
          backgroundColor: '#e7f3ff',
          padding: '1rem',
          borderRadius: '8px',
          border: '2px solid #667eea'
        }}>
          これはインラインスタイルが適用されたボックスです
        </div>
      </section>

      <section style={{ marginBottom: '2rem' }}>
        <h2>条件付きレンダリング</h2>
        {age >= 20 ? (
          <p style={{ color: 'green' }}>✓ 成人です</p>
        ) : (
          <p style={{ color: 'orange' }}>未成年です</p>
        )}
      </section>

      <div style={{
        backgroundColor: '#fff3cd',
        padding: '1rem',
        borderRadius: '8px',
        marginTop: '2rem'
      }}>
        <h3>💡 このレッスンで学んだこと</h3>
        <ul>
          <li>JSXでの変数表示: {'{変数名}'}</li>
          <li>配列のmap()でリスト表示</li>
          <li>インラインスタイルの書き方</li>
          <li>三項演算子での条件付きレンダリング</li>
        </ul>
      </div>
    </div>
  );
}

export default Lesson01;
