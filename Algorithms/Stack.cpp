//Author: Liam Maloney
//			A simple Stack implementation

#include "stdafx.h"
#include <iostream>

class WordStack{

	struct stackItem{
		char letter = NULL;
		stackItem* previous = NULL;
	};

	stackItem* top = NULL;
	int countOnStack = NULL;

public:

	bool isEmpty(){ return ((top == NULL) ? true : false); }

	char pop(){
		if (!isEmpty()){
			char popped = top->letter;
			//shadow pointer to keep track of old top to enable deletion
			stackItem* oldTop = top;
			//assign top to previous item
			top = top->previous;
			delete oldTop;
			countOnStack--;
			return popped;
		} 
	}

	void push(char newLetter){
		stackItem* newItem = new stackItem;
		(*newItem).letter = newLetter;
		//set what is below the current top to be below
		//the new item.
		if (isEmpty()){
			//if it is empty, then set it to be above NULL
			(*newItem).previous = NULL;
		} else {
			//otherwise, set 
			(*newItem).previous = top;
		}
		//set the top to the new item
		top = newItem;
		countOnStack++;
	}
};