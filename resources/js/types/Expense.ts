import { Category } from "./Category";
import { Salary } from "./Salary";

export interface Expense {
    id: number;
    value: string;
    salary_id: number;
    category_id: number;
    salary: Salary;
    category: Category;
}