#include "stdafx.h"
#include <iostream>
#include <time.h>
#include <fstream>
#include <string>

//A Non Perfect implementation of Quick Sort
//Takes a file from command line and sorts in memory
//TODO: implement Binary Search

void swap(unsigned long right, unsigned long left, unsigned long numbers[])
{
	unsigned long temp = numbers[right];
	numbers[right] = numbers[left];
	numbers[left] = temp;
}

void partitionStep(unsigned long numbers[], unsigned long left, unsigned long right)
{
	unsigned long oldLeft = left;
	unsigned long oldRight = right;
	unsigned long pivot = numbers[(oldLeft + oldRight) / 2l];
	while (left != right)
	{
		while ((numbers[left] < pivot) && (left != right))
		{
			left++;
		}

		while ((numbers[right] > pivot) && (left != right))
		{
			right--;
		}

		if (left != right)
		{
			swap(right, left, numbers);
		}
	}

	if (oldLeft != oldRight-1l && oldLeft != oldRight)
	{
		partitionStep(numbers, oldLeft, right);

	}

	if (oldLeft + 1l != oldRight && oldLeft != oldRight)
	{
		partitionStep(numbers, right, oldRight);
	}
}

void loadFile(unsigned long unsortedArr[], std::string source)
{
	std::fstream data;
	data.open(source);
	unsigned long i = 0;
	unsigned long dataCurrent = 0;
	while (!data.eof())
	{
		data >> dataCurrent;
		unsortedArr[i] = dataCurrent;
		i++;
	}
}

unsigned long determinSize(std::string sourceName)
{
	std::fstream data;
	data.open(sourceName);
	unsigned long count = 0;
	std::string current;
	while (data >> current)
	{
		count++;
		std::cout << count << std::endl;
	}
	return count;
}

int main(int argc, char *argv[])
{
	const int SOURCE_FILE = 1;
	std::string sourceName;
	sourceName = argv[SOURCE_FILE];
	std::cout << "Counting Elements..." << std::endl;
	unsigned long size = determinSize(sourceName);
	unsigned long* numArr = new unsigned long[size];
	loadFile(numArr, sourceName);
	std::cout << "Begin Sorting..." << std::endl;
	partitionStep(numArr, 0, size - 1);
	std::cout << "Sorted" << std::endl;
	delete [] numArr;
}
