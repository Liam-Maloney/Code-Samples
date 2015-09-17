//	Author: Liam Maloney, Carlow Institute of Technology
//			A simple Linked List implementation

#include "stdafx.h"
#include <iostream>

class IntegerLinkedList {
	
	//Number of elements in the list.
	int count = 0;

	struct Node {
		Node* next;
		int number = NULL;	
	};
	
	Node* head;				//pointer to next element
	Node* current;			//pointer to the currently selected item

	//traverses to the end of the list
	//sets the current pointer to last item
	void traverse() {
		while (current->next != NULL) {
			current = current->next;
		}
	}

public:

	IntegerLinkedList(){ head = NULL; current = head; }

	bool isEmpty() { return (head == NULL ? true : false); }
	void reset() { current = head; }

	void append(int newNumber) {
		//add node to end of list
		Node* newNode = new Node;
		//new node next pointer set to NULL as this node will be at end
		newNode->next = NULL;
		newNode->number = newNumber;
		if (isEmpty()) {
			head = newNode;
		} else {
			//traverse the current pointer to the end and feed a 
			//reference to the newly created node in to the last node.
			traverse();
			current->next = newNode;
		}
		//reset current pointer to head
		reset();
		count++;
	}

	void cap(int newNumber) {
		//add new node to the beginning of the list
		Node* newNode = new Node;
		//new node next pointer set to current first element
		newNode->next = head;
		newNode->number = newNumber;
		head = newNode;
		reset();
		count++;
	}

	void insertAt(int newNumber, int index) {
		if (index > count) {
			append(newNumber);
		} else if(isEmpty() || index == 0) {
			cap(newNumber);
		} else {
			//set up new node
			Node* newNode = new Node;
			Node* shadowNode = NULL;
			newNode->number = newNumber;
			for (int i = 0; i < index; i++) {
				//set current pointer to required location, 
				//and maintain reference to previous node
				shadowNode = current;
				current = current->next;
			}
			//link next pointer in newNode to the current pointer
			newNode->next = current;
			//set the previous node's next to the new node address
			shadowNode->next = newNode;
			count++;
		}
		reset();
	}

	void displayAll() {
		while (current->next != NULL) {
			std::cout << current->number << std::endl;
			current = current->next;
		}
		std::cout << current->number << std::endl;
	}

	int countItems(int total = 0) {
		if (current->next == NULL) {
			reset();
			total != 0 ? total++ : total = 0;
		} else {
			current = current->next;
			return countItems(++total);
		}
		return total;
	}
};