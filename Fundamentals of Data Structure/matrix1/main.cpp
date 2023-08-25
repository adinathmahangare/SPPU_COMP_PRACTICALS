/*Write Python program for storing matrix. Write functions for
a) Check whether given matrix is upper triangular or not
b) Compute summation of diagonal elements
c) Compute transpose of matrix*/

#include<iostream>
using namespace std;
class Matrix
{   int a[10][10],c[10][10],m[10][10],i,j,k,n,d;
     public:
      void getdata();
      void display();
      void trans();
      void diagonal();
      void triangle();
};

void Matrix::getdata()
{
    cout<<"Enter the size of square matrix(n*n) : \n";
    cin>>n;
    cout<<"\nEnter the elements of matrix : \n";
    for(i=0;i<n;i++)
    {
        for(j=0;j<n;j++)
        cin>>a[i][j];
    }
}

void Matrix :: triangle()
{
    int flag;
    for (i = 1; i < n; i++)
	for (j = 0; j < i; j++)
		if (a[i][j] != 0)
			flag = 0;
		else
			flag = 1;

	if (flag == 1)
		cout <<"\nUpper Triangular Matrix";
	else
		cout <<"\nNot an Upper Triangular Matrix";
		cout<<"\n";
}

void Matrix::trans()
{
    for(i=0;i<n;i++)
        {
            for(j=0;j<n;j++)
            c[i][j]=a[j][i];
        }
}

void Matrix::diagonal()
{
    d=0;
    for(i=0;i<n;i++)
    {
        for(j=0;j<n;j++)
            if(i==j)
            {
                d=d+a[i][j];
            }
    }
}

void Matrix::display()
{
    cout<<"\nTranspose of matrix : \n";
    for(i=0;i<n;i++)
    {
        for(j=0;j<n;j++)
            cout<<c[i][j]<<"\t";
            cout<<"\n";
    }
    cout<<"\nSum of diagonal elements of matrix :\n"<<d;
}

int main()
{
    Matrix b;
    b.getdata();
    b.trans();
    b.diagonal();
    b.triangle();
    b.display();

return 0;
}

