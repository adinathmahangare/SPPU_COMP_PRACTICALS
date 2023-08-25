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
};

void Matrix::getdata()
{
    cout<<"enter the size of square matrix(n*n) : \n";
    cin>>n;
    cout<<"enter the elements of matrix : \n";
    for(i=0;i<n;i++)
    {
        for(j=0;j<n;j++)
        cin>>a[i][j];
    }
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
    b.display();

return 0;
}

