//AUTHOR: Liam Maloney, Carlow Institute of Technology
//			A simple Queue implementation.

#include "stdafx.h"
#include <iostream>

class NumberQueue {
	
	struct queueItem {
		int number = NULL;
		queueItem* next = NULL;
	};

	queueItem* head = NULL;
	queueItem* tail = NULL;

public:

	void enqueue(int newNumber) {
		queueItem* newItem = new queueItem;
		newItem->number = newNumber;
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
			int dequeuedNumber = head->number;
			queueItem* shadow = head;
			head = head->next;
			delete shadow;
			return dequeuedNumber;
		}
	}

	bool isEmpty() { return ((head == NULL) ? true : false); }
};