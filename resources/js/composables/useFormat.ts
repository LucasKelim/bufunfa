export function formatCurrency(value: string | number, currency: string)
{
    return new Intl.NumberFormat('pt-BR', {
        style: 'currency',
        currency: currency
    }).format(Number(value));
}

export function formatCreatedAt(date: Date)
{
    return new Date(date).toLocaleDateString('pt-BR', {
        year: 'numeric',
        month: '2-digit',
        day: '2-digit'
    });
}
