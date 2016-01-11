//Author: Liam Maloney
//			Contains attempted implementations of a very simple: 
//				1. Binary Tree
//				2. Binary Search Tree
//				3. AVL(Height balanced) Tree.

#include "stdafx.h"
#include <iostream>

class BinaryTree {
	
protected:
	
	struct Node {
		Node* LChild = NULL;
		Node* RChild = NULL;
		int data = NULL;
	};
	Node* root = NULL;

	//Returns the reference to the node with 
	//the desired value.  Used for finding position of
	//items when inserting children.
	Node* hit = NULL;
	Node* search(Node* current, int searchFor){
		if (current != NULL){
			if (current->data == searchFor) {
				hit = current;
			} else {
				if (current->LChild != NULL) {
					search(current->LChild, searchFor);
				}
				if (current->RChild != NULL) {
					search(current->RChild, searchFor);
				}
			}
		}
	return hit;
}

public:

	BinaryTree(){};
	BinaryTree(int initialValue) {
		Node* firstNode = new Node;
		firstNode->data = initialValue;
		root = firstNode;
	}

	Node* getRoot(){
		return root;
	}

	//-----------------TRAVERSALS-----------------------

	//VLR
	void preOrder(Node* current){
		if (root != NULL){
			std::cout << current->data << std::endl;
			if (current->LChild != NULL) {
				preOrder(current->LChild);
			}
			if (current->RChild != NULL) {
				preOrder(current->RChild);
			}
		}
	}

	//LVR
	void inOrder(Node* current){
		if (root != NULL){
			if (current->LChild != NULL) {
				inOrder(current->LChild);
			}
			std::cout << current->data << std::endl;
			if (current->RChild != NULL) {
				inOrder(current->RChild);
			}
		}
	}

	//LRV
	void postOrder(Node* current){
		if (root != NULL){
			if (current->LChild != NULL) {
				postOrder(current->LChild);
			}
			if (current->RChild != NULL) {
				postOrder(current->RChild);
			}
			std::cout << current->data << std::endl;
		}
	}

	//------------END TRAVERSALS--------------------

	//only empty if root == NULL
	bool isEmpty(){ return root; }

	void addLeft(int node, int value){
		Node* parent = search(root, node);
		Node* newNode = new Node;
		newNode->data = value;
		parent->LChild = newNode;
	}

	void addRight(int node, int value){
		Node* parent = search(root, node);
		Node* newNode = new Node;
		newNode->data = value;
		parent->RChild = newNode;
	}

	int size(Node* current) {
		int total = 1;
		if (root != NULL){
			if (current->LChild != NULL) {
				total += size(current->LChild);
			}
			if (current->RChild != NULL) {
				total += size(current->RChild);
			}
		}
		return total;
	}
};

class BST : public BinaryTree {

public:
	BST(){};
	BST(int initialRoot) : BinaryTree(initialRoot){};

	void insert(Node* current, int insertValue){
		if(insertValue < current->data) {
			if(current->LChild != NULL) {
				insert(current->LChild, insertValue);
			} else {
				Node* newNode = new Node;
				newNode->data = insertValue;
				current->LChild = newNode;
			}
		} else if(insertValue > current->data) {
			if(current->RChild != NULL){
				insert(current->RChild, insertValue);
			} else {
				Node* newNode = new Node;
				newNode->data = insertValue;
				current->RChild = newNode;
			}
		}
	}
	void search(){}
};

class AVL : public BST {

	struct Node {
		Node* LChild = NULL;
		Node* RChild = NULL;
		int data = NULL;

		//avl specific attributes
		//heights initially set to -1 to avoid special cases where the child is null
		int balance = 0;
		Node* parent = NULL;
		int LHeight = 0;
		int RHeight = 0;
	};
	Node* root;

	int maxHeight(Node* maxOf){
		return (maxOf->RHeight > maxOf->LHeight) ? maxOf->RHeight : maxOf->LHeight;
	}

	//-------------------------ROTATIONS----------------------//

	void leftRotate(Node* rotateAt) {
		Node* oldRoot = rotateAt->parent;
		rotateAt->parent = rotateAt->RChild;
		rotateAt->RChild = rotateAt->RChild->LChild;
		rotateAt->parent->LChild = rotateAt;
		rotateAt->parent->parent = oldRoot;
		if (rotateAt == root){
			root = rotateAt->parent;
			rotateAt->parent->parent = root;
		} else {
			bool rotationInParentsRightSubtree;

			if (oldRoot->RChild == rotateAt){
				rotationInParentsRightSubtree = true;
			}
			else {
				rotationInParentsRightSubtree = false;
			}

			if (rotationInParentsRightSubtree){
				oldRoot->RChild = rotateAt->parent;
			}
			else {
				oldRoot->LChild = rotateAt->parent;
			}
		}
		rotateAt->RHeight = rotateAt->parent->LHeight;
		rotateAt->parent->LHeight = maxHeight(rotateAt)+1;
		if (rotateAt->parent->RChild != NULL){
			rotateAt->parent->RHeight = maxHeight(rotateAt->parent->RChild) + 1;
		}
		postRotationBalance(rotateAt);
	}

	void rightRotate(Node* rotateAt) {
		Node* oldRoot = rotateAt->parent;
		rotateAt->parent = rotateAt->LChild;
		rotateAt->LChild = rotateAt->LChild->RChild;
		rotateAt->parent->RChild = rotateAt;
		rotateAt->parent->parent = oldRoot;
		if (rotateAt == root){
			root = rotateAt->parent;
			rotateAt->parent->parent = root;
		}
		else {
			bool rotationInParentsRightSubtree;

			if (oldRoot->RChild == rotateAt){
				rotationInParentsRightSubtree = true;
			}
			else {
				rotationInParentsRightSubtree = false;
			}

			if (rotationInParentsRightSubtree){
				oldRoot->RChild = rotateAt->parent;
			}
			else {
				oldRoot->LChild = rotateAt->parent;
			}
		}
		rotateAt->LHeight = rotateAt->parent->RHeight;
		rotateAt->parent->RHeight = maxHeight(rotateAt) + 1;
		if (rotateAt->parent->LChild != NULL){
			rotateAt->parent->LHeight = maxHeight(rotateAt->parent->LChild) + 1;
		}
		postRotationBalance(rotateAt);
	}

	void postRotationBalance(Node* balanceAt){
		calculateBalance(balanceAt);
		calculateBalance(balanceAt->parent);
	}
	//----------------------END ROTATIONS---------------------//

public:

	AVL(int initialRoot) {
		Node* firstNode = new Node;
		firstNode->data = initialRoot;
		root = firstNode;
		firstNode->parent = root;
	};

	Node* getRoot(){
		return root;
	}

	void insert(int insertValue, Node* current = NULL){
		current = ((current == NULL) ? this->root : current = current);
		//search for the location to insert it in
		if (insertValue < current->data) {
			current->LHeight++;
			if (current->LChild != NULL) {
				insert(insertValue, current->LChild);
			}
			else {
				Node* newNode = new Node;
				newNode->data = insertValue;
				current->LChild = newNode;
				newNode->parent = current;
				//if this node has a sibling, then the height increases must be rolled back from the current->parent
				if (current->RChild != NULL && current != root){
					rollbackHeights(current->parent, insertValue);
				}
			}
		} else if (insertValue > current->data) {
			current->RHeight++;
			if (current->RChild != NULL){
				insert(insertValue, current->RChild);
			} else {
				Node* newNode = new Node;
				newNode->data = insertValue;
				current->RChild = newNode;
				newNode->parent = current;
				//if this node has a sibling, then the height increases must be rolled back from the current->parent
				if (current->LChild != NULL && current != root){
					rollbackHeights(current->parent, insertValue);
				}
			}
		}
		calculateBalance(current);
		decideRotation(current);
		calculateBalance(current);
	}

	void calculateBalance(Node* current){
		current->LHeight = (current->LChild != NULL) ? maxHeight(current->LChild) + 1 : 0;
		current->RHeight = (current->RChild != NULL) ? maxHeight(current->RChild) + 1 : 0;
		current->balance = (current->LChild != NULL ? maxHeight(current->LChild) : -1) - (current->RChild != NULL ? maxHeight(current->RChild) : -1);
	}

	void decideRotation(Node* current){
		calculateBalance(current);
		if (current->balance < -1){
			if (current->RChild->balance == 1){
				rightRotate(current->RChild);
			}
			leftRotate(current);
		} else if (current->balance > 1) {
			if (current->LChild->balance == -1){
				leftRotate(current->LChild);
			}
			rightRotate(current);
		}
	};
	
	void rollbackHeights(Node* current, int newInsert){
		if(newInsert < current->data){
			current->LHeight--;
		} else {
			current->RHeight--;
		} 
		if (current != root){
			rollbackHeights(current->parent, newInsert);
		}
	}
	
	int getBalance(Node* balanceAt){
		return balanceAt->balance;
	};

	//--------------OVERRIDES FROM BINARY TREE-----------------//

	Node* searchUtility(Node* current, int searchFor){
	
		if (current != NULL)
		{
			if (current->data < searchFor){
				current = searchUtility(current->RChild, searchFor);
			}
			else if (current->data > searchFor){
				current = searchUtility(current->LChild, searchFor);
			}
		}
		return current;
	}

	Node* search(int searchFor){
		return searchUtility(this->root, searchFor);
	}

	//-----------------TRAVERSALS-----------------------

	//VLR
	void preOrder(Node* current){
		if (root != NULL){
			std::cout << current->data << std::endl;
			if (current->LChild != NULL) {
				preOrder(current->LChild);
			}
			if (current->RChild != NULL) {
				preOrder(current->RChild);
			}
		}
	}

	//LVR
	void inOrder(Node* current){
		if (root != NULL){
			if (current->LChild != NULL) {
				inOrder(current->LChild);
			}
			std::cout << current->data << std::endl;
			if (current->RChild != NULL) {
				inOrder(current->RChild);
			}
		}
	}

	//LRV
	void postOrder(Node* current){
		if (root != NULL){
			if (current->LChild != NULL) {
				postOrder(current->LChild);
			}
			if (current->RChild != NULL) {
				postOrder(current->RChild);
			}
			std::cout << current->data << std::endl;
		}
	}

	//------------END TRAVERSALS--------------------

	//only empty if root == NULL
	bool isEmpty(){ return root; }

	void addLeft(int node, int value){
		//search for the position to insert the new node under
		Node* parent = search(node);
		Node* newNode = new Node;
		newNode->data = value;
		parent->LChild = newNode;
	}

	void addRight(int node, int value){
		//search for the position to insert the new node under
		Node* parent = search(node);
		Node* newNode = new Node;
		newNode->data = value;
		parent->RChild = newNode;
	}

	int size(Node* current) {
		int total = 1;
		if (root != NULL){
			if (current->LChild != NULL) {
				total += size(current->LChild);
			}
			if (current->RChild != NULL) {
				total += size(current->RChild);
			}
		}
		return total;
	}
};

int main()
{
	AVL tree(100);
	tree.insert(22);
	tree.insert(1);
	tree.insert(3);
	tree.insert(444);
	tree.insert(45);
		
	std::cout << tree.search(45)->data << std::endl;
	system("pause");
}