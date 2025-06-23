from flask import Flask, request, jsonify
from recommender import recommend_by_product_id

app = Flask(__name__)

@app.route('/recommend', methods=['GET'])
def recommend():
    product_id = int(request.args.get('product_id'))
    recommendations = recommend_by_product_id(product_id)
    return jsonify(recommendations)

if __name__ == '__main__':
    app.run(port=5001, debug=True)


