#include "stdafx.h"
#include <list>
#include <string>
#include <iostream>
#include <algorithm>
#include <queue>

template <typename T> class DiGraph
{
	//------------------- GRAPH STRUCTURES------------------------

	struct Node;

	enum Color
	{
		FINISHED, 
		PROCESSING, 
		UNDISCOVERED
	};

	struct Arc
	{
		Node* nodeArcPointsTo;
	};

	struct Node
	{
		Color status = UNDISCOVERED;
		bool notVisitedYet = true;
		T dataContainedAtNode;
		std::list<Arc*> arcs;	//needs to be a list of pointers, 
								//as I will be using the address to delete particular Arcs
	};

	std::list<Node*> graphNodesList;

	//---------------- END GRAPH STRUCTURES------------------------

	//--------------------OPERATIONS-------------------------------

	void resetNodesColor()
	{
		std::list<Node*>::iterator traversesGraphNodes = graphNodesList.begin();
		for (std::list<Node*>::iterator traversesGraphNodes = graphNodesList.begin();
			traversesGraphNodes != graphNodesList.end(); traversesGraphNodes++)
		{
			(*traversesGraphNodes)->status = UNDISCOVERED;
		}
	}

	void resetNodesStatus()
	{
		std::list<Node*>::iterator traversesGraphNodes = graphNodesList.begin();
		for (std::list<Node*>::iterator traversesGraphNodes = graphNodesList.begin(); 
			traversesGraphNodes != graphNodesList.end(); traversesGraphNodes++)
		{
			(*traversesGraphNodes)->notVisitedYet = true;
		}
	}

	Node* findNode(T findNodeWithThisData)
	{
		std::list<Node*>::iterator findsNode = graphNodesList.begin();
		while (((*findsNode)->dataContainedAtNode != findNodeWithThisData))
		{
			findsNode++;
		}
		return *findsNode;
	}

	Arc* findArc(Node* findArcFromHere, Node* findArcToHere)
	{
		std::list<Arc*>::iterator findsArc = findArcFromHere->arcs.begin();
		while ((*findsArc)->nodeArcPointsTo != findArcToHere)
		{
			findsArc++;
		}
		return *findsArc;
	}

public:

	bool isEmpty()
	{
		return graphNodesList.empty();
	};

	void addNode(T newNodeData)
	{
		Node* newNode = new Node;
		newNode->dataContainedAtNode = newNodeData;
		graphNodesList.push_back(newNode);
	}

	void addArc(T nodeToAddArc, T newArcLinkTo)
	{
		Node* sourceOfArc = findNode(nodeToAddArc);
		Node* destinationOfArc = findNode(newArcLinkTo);
		Arc* newArc = new Arc;
		newArc->nodeArcPointsTo = destinationOfArc;
		sourceOfArc->arcs.push_back(newArc);
	}

	void removeArc(T dataOfNodeToRemoveArcFrom, T dataOfNodeWhichArcGoesTo)
	{
		Node* nodeToRemoveArcFrom = findNode(dataOfNodeToRemoveArcFrom);
		Node* removeArcTo = findNode(dataOfNodeWhichArcGoesTo);
		Arc* arcToRemove = findArc(nodeToRemoveArcFrom, removeArcTo);
		nodeToRemoveArcFrom->arcs.remove(arcToRemove);
		delete arcToRemove;
	}

	void removeNode(T dataOfNodeToRemove)
	{
		Node* nodeToRemove = findNode(dataOfNodeToRemove);
		graphNodesList.remove(nodeToRemove);
		delete nodeToRemove;
	}

	bool isEdgeBetween(T connectionFrom, T connectionTo)
	{
		bool isConnected = false;
		Node* connectionFromNode = findNode(connectionFrom);
		Node* lookingForAConnectionToThis = findNode(connectionTo);
		std::list<Arc*>::iterator findsArc = connectionFromNode->arcs.begin();
		std::list<Arc*>::iterator delimitsEndOfSearch = connectionFromNode->arcs.end();
		delimitsEndOfSearch--;
		//Scans through the list of Arcs at the Source Node, and stops when it reaches the end or the mem address of 
		//the node we are testing to see if there is a connection to.
		while (((*findsArc)->nodeArcPointsTo != lookingForAConnectionToThis) && findsArc != delimitsEndOfSearch)
		{
			findsArc++;
		}
		if ((*findsArc)->nodeArcPointsTo == lookingForAConnectionToThis)
		{
			isConnected = true;
		}
		return isConnected;
	}

	void depthFirstSearch(T startDFSFromThisNode)
	{
		Node* startPointerForDFSRun = findNode(startDFSFromThisNode);
		DFSRun(startPointerForDFSRun);
		resetNodesStatus();
	}

	void DFSRun(Node* current)
	{
		current->notVisitedYet = false;
		std::cout << current->dataContainedAtNode << std::endl;

		if (current->arcs.empty())
		{
			//if the Arcs are empty at this node, we do not need to do anything.
			return;
		}
		else
		{
			for (std::list<Arc*>::iterator traversesArcs = current->arcs.begin();
				traversesArcs != current->arcs.end(); traversesArcs++)
			{
				if ((*traversesArcs)->nodeArcPointsTo->notVisitedYet)
				{
					DFSRun((*traversesArcs)->nodeArcPointsTo);
				}
			}
			return;
		}
	}

	void breadthFirstSearch(T nodeToBeginSearchAt)
	{
		Node* nodePointerToStartBFSAt = findNode(nodeToBeginSearchAt);
		nodePointerToStartBFSAt->status = PROCESSING;
		BFSRun(nodePointerToStartBFSAt);
		resetNodesStatus();
	}

	void BFSRun(Node* current)
	{
		static std::queue<Node*> nextNodeToProcess;
		std::cout << current->dataContainedAtNode << std::endl;

		if (current->arcs.empty())
		{
			current->status = FINISHED;
			return;
		}
		else
		{
			for (std::list<Arc*>::iterator traversesArcs = current->arcs.begin(); 
				traversesArcs != current->arcs.end(); traversesArcs++)
			{
				if ((*traversesArcs)->nodeArcPointsTo->status == UNDISCOVERED)
				{
					(*traversesArcs)->nodeArcPointsTo->status = PROCESSING;
					nextNodeToProcess.push((*traversesArcs)->nodeArcPointsTo);
				}
			}

			current->status = FINISHED;

			if (nextNodeToProcess.empty())
			{
				return;
			}
			else
			{
				Node* nextToTraverse = nextNodeToProcess.front();
				nextNodeToProcess.pop();
				BFSRun(nextToTraverse);
			}
		}
	}

	//------------------END OPERATIONS-----------------------------
};

int main()
{	
	DiGraph<int> intGraph;

	for (int i = 0; i < 8; i++)
	{
		intGraph.addNode(i);
	}

	intGraph.addArc(0, 1);
	intGraph.addArc(0, 3);
	intGraph.addArc(1, 2);
	intGraph.addArc(1, 6);
	intGraph.addArc(2, 4);
	intGraph.addArc(3, 7);
	intGraph.addArc(5, 1);
	intGraph.addArc(6, 2);
	intGraph.addArc(6, 7);
	intGraph.addArc(7, 5);
	intGraph.addArc(7, 6);
	
	intGraph.breadthFirstSearch(0);

	system("pause");
}