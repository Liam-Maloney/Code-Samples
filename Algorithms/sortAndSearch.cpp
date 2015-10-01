#include "stdafx.h"

//A Non Perfect implementation of Quick Sort
//TODO: implement Binary Search

template<typename T, int size>
void swap(int right, int left, T(&numArr)[size])
{
	int temp = numArr[right];
	numArr[right] = numArr[left];
	numArr[left] = temp;
}

template<typename T, int size>
void partitionStep(T (&numArr)[size], int left, int right)
{
	//used as delimiters for the sets
	int oldLeft = left;
	int oldRight = right;
	int pivot = numArr[(oldLeft + oldRight) / 2];
	while (left != right)
	{
		while ((numArr[left] < pivot) && (left != right))
		{
			left++;
		}

		while ((numArr[right] > pivot) && (left != right))
		{
			right--;
		}

		if (left != right)
		{
			swap(right, left, numArr);
		}
	}

	if (oldLeft != oldRight-1 && oldLeft != oldRight)
	{
		partitionStep(numArr, oldLeft, right);

	}

	if (oldLeft + 1 != oldRight && oldLeft != oldRight)
	{
		partitionStep(numArr, right, oldRight);
	}
}