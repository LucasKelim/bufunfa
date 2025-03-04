import { User } from ".";
import { Expense } from "./Expense";

export interface Salary
{
    id: number;
    value: number | string;
    user_id: number;
    created_at: Date;
    expenses: Expense[];
    total_expenses: number;
    remaining_salary: number;
    user: User;
}
