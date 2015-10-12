//AUTHOR: Liam Maloney, Carlow Institute of Technology
//			A simple Queue implementation.

#include "stdafx.h"
#include <iostream>

template <typename T> class Queue {
	
	struct queueItem {
		T item = NULL;
		queueItem* next = NULL;
	};

	queueItem* head = NULL;
	queueItem* tail = NULL;

public:

	void enqueue(T newItem) {
		queueItem* newItem = new queueItem;
		newItem->item = newNumber;
		if (isEmpty()) {
			head = newItem;
			tail = newItem;
		} else {
			tail->next = newItem;
			tail = newItem;
		}
	}

	int dequeue() {
		if (!isEmpty()) {
			T dequeuedItem = head->item;
			queueItem* shadow = head;
			head = head->next;
			delete shadow;
			return dequeuedItem;
		}
	}

	bool isEmpty() { return ((head == NULL) ? true : false); }
};