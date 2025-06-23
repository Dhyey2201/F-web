import pandas as pd
from sklearn.feature_extraction.text import TfidfVectorizer
from sklearn.metrics.pairwise import cosine_similarity

# Load product data
df = pd.read_csv('products.csv')

# Combine features into a single string
df['features'] = df[['category', 'color', 'brand', 'gender']].agg(' '.join, axis=1)

# Vectorize features
vectorizer = TfidfVectorizer()
tfidf_matrix = vectorizer.fit_transform(df['features'])

# Compute cosine similarity
similarity_matrix = cosine_similarity(tfidf_matrix)

def recommend_by_product_id(product_id, top_n=3):
    try:
        index = df[df['product_id'] == product_id].index[0]
    except IndexError:
        return []
    
    similarity_scores = list(enumerate(similarity_matrix[index]))
    sorted_scores = sorted(similarity_scores, key=lambda x: x[1], reverse=True)
    
    # Exclude the item itself (index 0)
    top_indices = [i[0] for i in sorted_scores[1:top_n+1]]
    
    return df.iloc[top_indices][['product_id', 'name']].to_dict(orient='records')
